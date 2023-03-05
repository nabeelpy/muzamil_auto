<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\CashPaymentVoucherModel;
use App\Models\CreditSaleInvoiceModel;
use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\PartyModel;
use App\Models\ProductRecover;
use App\Models\SaleInvoiceForJobsModel;
use App\Models\SaleInvoiceItemsModel;
use App\Models\SaleInvoiceModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:sale-invoice-list', ['only' => ['index','show']]);
        $this->middleware('permission:sale-invoice-create', ['only' => ['create','store']]);
    }

    public function index(Request $request)
    {
        $datas = DB::table('sale_invoice')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'sale_invoice.si_cash_account')
            ->leftJoin('party', 'party.party_id','=', 'sale_invoice.si_party_id')
            ->orderBy('si_id','Desc');


        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('sale_invoice.si_id', 'like', '%' . $request->job_no . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('sale_invoice.si_created_at', '>=', $request->from_date)
                ->whereDate('sale_invoice.si_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('sale_invoice.si_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('sale_invoice.si_created_at', '=', $request->to_date);
        }



        $query = $query->get();



        return view('sale_invoice/sale_invoice_list', compact( 'job_no',  'from_date', 'to_date','query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cash = CashAccountModel::all();
        $parts = PartsModel::where("par_status","=","Opening")->get();
        $party = PartyModel::all();

        return view('sale_invoice/add_sale_invoice',compact('cash','parts','party'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'account' => 'required',
            'party' => 'required',
            'total_item' => 'required|integer|min:1',
            'grand_total' => 'required|integer|min:0',
            'p_amount' => 'required|integer|min:0',
            'remaining' => 'required|integer|min:0',
            'st_qty.*' => 'required|integer|min:1',
            'qty.*' => 'required|integer|min:1',
        ]);

        global $si_id;
        DB::transaction(function () use( $request ,$si_id) {
            $auth = Auth::user();


            $requested_arrays = $request->parts;

//        add  data to sale invoice
            $pr = new SaleInvoiceModel();
            $pr->si_cash_account = $request->account;
            $pr->si_party_id = $request->party;
            $pr->si_grand_total = $request->grand_total;
            $pr->si_total_items = $request->total_item;
            $pr->si_amount_pay = $request->p_amount;
            $pr->si_remaining = $request->remaining;

            if ($request->remaining == 0) {
                $pr->si_status = "Paid";
            } else {
                $pr->si_status = "Credit";
            }


            $pr->si_remarks = $request->remarks;
            $pr->si_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'pr';
            $prfx = 'si';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $pr->save();





//            add into credit sale invoice

            $credit_sale_invoice = new CreditSaleInvoiceModel();
            $credit_sale_invoice->csi_cash_account = $request->account;
            $credit_sale_invoice->csi_party_id = $request->party;
            $credit_sale_invoice->csi_si_id = $pr->si_id;
            $credit_sale_invoice->csi_amount_paid = $request->p_amount;
            $credit_sale_invoice->csi_real_estimated_cost = $request->grand_total;
            $credit_sale_invoice->csi_estimated_cost = $request->remaining;
            $credit_sale_invoice->csi_remaining_cost = $request->remaining;
            $credit_sale_invoice->csi_discount = 0;
            $credit_sale_invoice->csi_remarks = $request->remarks;
            $credit_sale_invoice->csi_user_id = $auth->id;


            if ($request->remaining == 0) {
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

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            // coding from shahzaib end
            $credit_sale_invoice->save();













            //        add cash book data
            $last_amount = CashBookModel::where("cb_ca_id", "=", $request->account)->OrderBy("cb_id", 'DESC')->first();


            if ($last_amount == null) {
                $new_amount = $request->p_amount;
            } else {
                $new_amount = $last_amount->cb_total + $request->p_amount;
            }

            $cash_book = new CashBookModel();
            $cash_book->cb_ca_id = $request->account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Sale_Invoice";
            $cash_book->cb_type_id = $pr->si_id;
            $cash_book->cb_in = $request->p_amount;
            $cash_book->cb_total = $new_amount;
            $cash_book->save();


//         add data to Cash Account table
            $pat = CashAccountModel::where("ca_id", "=", $request->account)->first();
            $pat->ca_balance = $pat->ca_balance + $request->p_amount;
            $pat->save();


            //        add  data to sale invoice items
            foreach ($requested_arrays as $index => $requested_array) {
                $sale_items = new SaleInvoiceItemsModel();
                $sale_items->sii_user_id = $auth->id;
                $sale_items->sii_si_id = $pr->si_id;
                $sale_items->sii_part_name = $request->parts[$index];
                $sale_items->sii_qty = $request->qty[$index];
                $sale_items->sii_rate = $request->rate[$index];
                $sale_items->sii_discount = $request->discount[$index];
                $sale_items->sii_amount = $request->tamount[$index];

                $sale_items->save();


                $pat = PartsModel::where("par_id", "=", $request->parts[$index])->first();
                $pat->par_total_qty = $pat->par_total_qty - $request->qty[$index];
                $pat->save();


                //        add stock data
                $last_qty = StockModel::where("sto_par_id", "=", $request->parts[$index])->OrderBy("sto_id", 'DESC')->first();


                if ($last_qty == null) {
                    $new_qty = $request->qty[$index];
                } else {
                    $new_qty = $last_qty->sto_total - $request->qty[$index];
                }


                $stock = new StockModel();
                $stock->sto_par_id = $request->parts[$index];
                $stock->sto_user_id = $auth->id;
                $stock->sto_type = "Sale_Invoice";
                $stock->sto_type_id = $pr->si_id;
                $stock->sto_out = $request->qty[$index];
                $stock->sto_out_rate = $request->rate[$index];
                $stock->sto_out_discount = $request->discount[$index];
                $stock->sto_out_amount = $request->tamount[$index];
                $stock->sto_total = $new_qty;
                $stock->save();

            }
            global $si_id;
            $si_id = $pr->si_id;

//        store in parts table
//        foreach ($requested_arrays as $index => $requested_array) {


//        }

        });
        return redirect()->back()->with('si_id',$si_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
