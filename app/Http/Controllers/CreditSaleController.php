<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\JobInformationModel;
use App\Models\CreditSaleInvoiceModel;
use App\Models\SaleInvoiceItemsModel;
use App\Models\SaleInvoiceModel;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreditSaleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:detail-sale-invoice-list', ['only' => ['credit_sale_list']]);
        $this->middleware('permission:sale-invoice-edit', ['only' => ['add_credit_sale','store_credit_sale']]);
    }


    public function credit_sale_list(Request $request)
    {
        $datas = DB::table('credit_sale_invoice')
            ->leftJoin('users', 'users.id','=', 'credit_sale_invoice.csi_user_id')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'credit_sale_invoice.csi_cash_account')
            ->leftJoin('party', 'party.party_id','=', 'credit_sale_invoice.csi_party_id')
            ->orderBy('csi_id','Desc');



        $status = $request->status;
        $sale_invoice = $request->sale_invoice;
        $invoice = $request->invoice;
        $account = $request->account;
        $party = $request->party;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->status)) {
            $query->where('credit_sale_invoice.csi_status', '=', $request->status);
        }

        if (isset($request->sale_invoice)) {
            $query->where('credit_sale_invoice.csi_si_id', '=', $request->sale_invoice);
        }


        if (isset($request->invoice)) {
            $query->where('credit_sale_invoice.csi_id', '=', $request->invoice);
        }


        if (isset($request->account)) {
            $query->where('cash_account.ca_name', 'like', '%' . $request->account. '%');
        }

        if (isset($request->party)) {
            $query->where('party.party_name', 'like', '%' . $request->party. '%');
        }


        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('sale_invoice.si_created_at', '>=', $request->from_date)
                ->whereDate('sale_invoice.si_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('credit_sale_invoice.csi_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('credit_sale_invoice.csi_created_at', '=', $request->to_date);
        }


        $query = $query->get();
//        dd($datas);


        return view('credit_sale/credit_sale_list', compact( 'status', 'from_date', 'to_date', 'query','account','party','sale_invoice','invoice'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_credit_sale($id)
    {
        $cash_accounts = CashAccountModel::all();
        $credit_sale_invoice_detail = SaleInvoiceModel::where("si_id","=",$id)
            ->first();

        $credit_sale_invoice = CreditSaleInvoiceModel::all();

        return view('credit_sale/add_credit_sale',compact('credit_sale_invoice','credit_sale_invoice_detail','cash_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_credit_sale(Request $request)
    {

        $this->validate($request, [
            'invoice' => 'required',
            'cash_account' => 'required',
            'amount' => 'required|integer|min:0',
            'estimated_cost' => 'required|integer|min:1',
            'remaining_estimated_cost' => 'required|integer|min:0',
        ]);

        global $si_id;
        DB::transaction(function () use( $request, $si_id ) {
            $auth = Auth::user();
            $credit_sale_invoice = new CreditSaleInvoiceModel();
            $credit_sale_invoice->csi_si_id = $request->invoice;
            $credit_sale_invoice->csi_cash_account = $request->cash_account;
            $credit_sale_invoice->csi_party_id = $request->party;
            $credit_sale_invoice->csi_amount_paid = $request->amount;
            $credit_sale_invoice->csi_real_estimated_cost = $request->real_estimated_cost;
            $credit_sale_invoice->csi_estimated_cost = $request->estimated_cost;
            $credit_sale_invoice->csi_remaining_cost = $request->remaining_estimated_cost;
            $credit_sale_invoice->csi_discount = $request->discount;
            $credit_sale_invoice->csi_remarks = $request->remarks;
            $credit_sale_invoice->csi_user_id = $auth->id;


            if ($request->remaining_estimated_cost == 0) {
                $credit_sale_invoice->csi_status = "Paid";
            } else {
                $credit_sale_invoice->csi_status = "Credit";
            }

            $t_amount_pay = $request->real_estimated_cost - $request->remaining_estimated_cost;

            // coding from shahzaib start
            $tbl_var_name = 'credit_sale_invoice';
            $prfx = 'csi';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
//            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
//            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $credit_sale_invoice->save();


            if ($request->remaining_estimated_cost == 0) {
                //        update Sale status
                SaleInvoiceModel::where("si_id", "=", $request->invoice)->update(['si_status' => "Paid", 'si_remaining' => $request->remaining_estimated_cost, 'si_amount_pay' => $t_amount_pay]);
            } else {
//        update Sale status
                SaleInvoiceModel::where("si_id", "=", $request->invoice)->update(['si_status' => "Credit", 'si_remaining' => $request->remaining_estimated_cost, 'si_amount_pay' => $t_amount_pay]);
            }


            //        update cash account
            $pat = CashAccountModel::where("ca_id", "=", $request->cash_account)->first();
            $pat->ca_balance = $pat->ca_balance + $request->amount;
            $pat->save();


            //        add cash book data
            $last_qty = CashBookModel::where("cb_ca_id", "=", $request->cash_account)->OrderBy("cb_id", 'DESC')->first();


            if ($last_qty == null) {
                $new_qty = $request->amount;
            } else {
                $new_qty = $last_qty->cb_total + $request->amount;
            }

            $cash_book = new CashBookModel();
            $cash_book->cb_ca_id = $credit_sale_invoice->csi_cash_account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Credit Sale Invoice";
            $cash_book->cb_type_id = $credit_sale_invoice->csi_id;
//            $cash_book->cb_job_id = $credit_sale_invoice->csi_id;
//            $cash_book->cb_job_id = $request->job_no;
            $cash_book->cb_in = $request->amount;
            $cash_book->cb_total = $new_qty;
            $cash_book->save();

            global $si_id;

            $si_id = $credit_sale_invoice->csi_si_id;



        });

//        dd($csi_id);


        return redirect()->back()->with('si_id',$si_id);
    }



    //sale_invoice_modal
    public
    function credit_sale_modal_view_details(Request $request)
    {
        $items = SaleInvoiceModel::where('si_id', $request->id)
            ->leftJoin('sale_invoice_items', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->leftJoin('credit_sale_invoice', 'credit_sale_invoice.csi_si_id','=', 'sale_invoice.si_id')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->get();

        return response()->json($items);
    }

    public
    function credit_sale_modal_view_details_SH(Request $request, $id)
    {


//        $items = SaleInvoiceModel::where('si_id', $request->id)
//            ->leftJoin('sale_invoice_items', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
//            ->leftJoin('credit_sale_invoice', 'credit_sale_invoice.csi_si_id','=', 'sale_invoice.si_id')
//            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
//            ->get();



        $items = DB::table('sale_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'sale_invoice_items.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->where('sii_si_id', $id)
            ->get();

        $credit_items = DB::table('credit_sale_invoice')
//            ->leftJoin('parts', 'parts.par_id','=', 'credit_sale_invoice.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'credit_sale_invoice.csi_si_id')
//            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->where('csi_si_id', $id)
            ->get();


//        return $items;

        $type = 'grid';
        $pge_title = 'Sale Invoice';

        return view('credit_sale/credit_sale_modal', compact( 'type', 'pge_title', 'items','credit_items'));
    }

    public
    function credit_sale_modal_view_details_pdf_SH(Request $request, $id)
    {

//        $items = SaleInvoiceModel::where('si_id', $request->id)
//            ->leftJoin('sale_invoice_items', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
//            ->leftJoin('credit_sale_invoice', 'credit_sale_invoice.csi_si_id','=', 'sale_invoice.si_id')
//            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
//            ->get();

        $items = DB::table('sale_invoice_items')
            ->leftJoin('parts', 'parts.par_id','=', 'sale_invoice_items.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'sale_invoice_items.sii_si_id')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->where('sii_si_id', $id)
            ->get();


        $credit_items = DB::table('credit_sale_invoice')
//            ->leftJoin('parts', 'parts.par_id','=', 'credit_sale_invoice.sii_part_name')
            ->leftJoin('sale_invoice', 'sale_invoice.si_id','=', 'credit_sale_invoice.csi_si_id')
//            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->where('csi_si_id', $id)
            ->get();

        $type = 'pdf';
        $pge_title = 'Sale Invoice';


//        $footer = view('invoice_view._partials.pdf_footer')->render();
//        $header = view('invoice_view._partials.pdf_header', compact('invoice_nbr', 'invoice_date', 'pge_title', 'type'))->render();
//        $options = [
//            'footer-html' => $footer,
//            'header-html' => $header,
//            'margin-top' => 24,
//        ];

        $pdf = SnappyPdf::loadView('credit_sale/credit_sale_modal_pdf', compact( 'items',    'type', 'pge_title','credit_items'));
//        $pdf->setOptions($options);

        return $pdf->stream('Sale-Invoice-Detail.pdf');
    }
}
