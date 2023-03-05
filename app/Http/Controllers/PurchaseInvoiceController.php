<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\CreditPurchaseInvoiceModel;
use App\Models\CreditSaleInvoiceModel;
use App\Models\PartsModel;
use App\Models\PartyModel;
use App\Models\PurchaseInvoiceItemsModel;
use App\Models\PurchaseInvoiceModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\b;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:purchase-invoice-list', ['only' => ['index','show']]);
        $this->middleware('permission:purchase-invoice-create', ['only' => ['create','store']]);
    }

    public function index(Request $request)
    {
        $datas = DB::table('purchase_invoice')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'purchase_invoice.pi_cash_account')
            ->leftJoin('party', 'party.party_id','=', 'purchase_invoice.pi_party_id')
            ->orderBy('pi_id','Desc');


        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('purchase_invoice.pi_id', 'like', '%' . $request->job_no . '%');
        }


        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('purchase_invoice.pi_created_at', '>=', $request->from_date)
                ->whereDate('purchase_invoice.pi_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('purchase_invoice.pi_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('purchase_invoice.pi_created_at', '=', $request->to_date);
        }


        $query = $query->get();

        return view('purchase_invoice/purchase_invoice_list', compact( 'job_no',  'from_date', 'to_date','query'));

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


        return view('purchase_invoice/add_purchase_invoice',compact('cash','parts','party'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        global $pi_id;

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


        DB::transaction(function () use( $request, $pi_id ) {
            $auth = Auth::user();


            $requested_arrays = $request->parts;

//        add  data to purchase invoice
            $pr = new PurchaseInvoiceModel();
            $pr->pi_cash_account = $request->account;
            $pr->pi_party_id = $request->party;
            $pr->pi_grand_total = $request->grand_total;
            $pr->pi_total_items = $request->total_item;
            $pr->pi_remarks = $request->remarks;
            $pr->pi_user_id = $auth->id;

            $pr->pi_amount_pay = $request->p_amount;
            $pr->pi_remaining = $request->remaining;

            if ($request->remaining == 0) {
                $pr->pi_status = "Paid";
            } else {
                $pr->pi_status = "Credit";
            }


            // coding from shahzaib start
            $tbl_var_name = 'pr';
            $prfx = 'pi';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $pr->save();





//            add into credit sale invoice

            $credit_purchase_invoice = new CreditPurchaseInvoiceModel();
            $credit_purchase_invoice->cpi_cash_account = $request->account;
            $credit_purchase_invoice->cpi_party_id = $request->party;
            $credit_purchase_invoice->cpi_pi_id = $pr->pi_id;
            $credit_purchase_invoice->cpi_amount_paid = $request->p_amount;
            $credit_purchase_invoice->cpi_real_estimated_cost = $request->grand_total;
            $credit_purchase_invoice->cpi_estimated_cost = $request->remaining;
            $credit_purchase_invoice->cpi_remaining_cost = $request->remaining;
            $credit_purchase_invoice->cpi_discount = 0;
            $credit_purchase_invoice->cpi_remarks = $request->remarks;
            $credit_purchase_invoice->cpi_user_id = $auth->id;


            if ($request->remaining == 0) {
                $credit_purchase_invoice->cpi_status = "Paid";
            } else {
                $credit_purchase_invoice->cpi_status = "Credit";
            }

            $t_amount_pay = $request->real_estimated_cost - $request->remaining_estimated_cost;

            // coding from shahzaib start
            $tbl_var_name = 'credit_purchase_invoice';
            $prfx = 'cpi';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            // coding from shahzaib end
            $credit_purchase_invoice->save();






            //        add cash book data
            $last_amount = CashBookModel::where("cb_ca_id", "=", $request->account)->OrderBy("cb_id", 'DESC')->first();


            if ($last_amount == null) {
                $new_amount = $request->p_amount;
            } else {
                $new_amount = $last_amount->cb_total - $request->p_amount;
            }

            $cash_book = new CashBookModel();
            $cash_book->cb_ca_id = $request->account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Purchase_Invoice";
            $cash_book->cb_type_id = $pr->pi_id;
            $cash_book->cb_out = $request->p_amount;
            $cash_book->cb_total = $new_amount;
            $cash_book->save();


//         add data to Cash Account table
            $pat = CashAccountModel::where("ca_id", "=", $request->account)->first();
            $pat->ca_balance = $pat->ca_balance - $request->p_amount;
            $pat->save();


            //        add  data to purchase invoice items
            foreach ($requested_arrays as $index => $requested_array) {
                $purchase_items = new PurchaseInvoiceItemsModel();
                $purchase_items->pii_user_id = $auth->id;
                $purchase_items->pii_pi_id = $pr->pi_id;
                $purchase_items->pii_part_name = $request->parts[$index];
                $purchase_items->pii_qty = $request->qty[$index];
                $purchase_items->pii_rate = $request->rate[$index];
                $purchase_items->pii_discount = $request->discount[$index];
                $purchase_items->pii_amount = $request->tamount[$index];

                $purchase_items->save();


                $pat = PartsModel::where("par_id", "=", $request->parts[$index])->first();
                $pat->par_total_qty = $pat->par_total_qty + $request->qty[$index];
                $pat->save();


                //        add stock data
                $last_qty = StockModel::where("sto_par_id", "=", $request->parts[$index])->OrderBy("sto_id", 'DESC')->first();


                if ($last_qty == null) {
                    $new_qty = $request->qty[$index];
                } else {
                    $new_qty = $last_qty->sto_total + $request->qty[$index];
                }


                $stock = new StockModel();
                $stock->sto_par_id = $request->parts[$index];
                $stock->sto_user_id = $auth->id;
                $stock->sto_type = "Purchase_Invoice";
                $stock->sto_type_id = $pr->pi_id;
                $stock->sto_in = $request->qty[$index];
                $stock->sto_in_rate = $request->rate[$index];
                $stock->sto_in_discount = $request->discount[$index];
                $stock->sto_in_amount = $request->tamount[$index];
                $stock->sto_total = $new_qty;
                $stock->save();

            }


//        store in parts table
//        foreach ($requested_arrays as $index => $requested_array) {

//        }
              global $pi_id;
            $pi_id=$pr->pi_id;
        });
        return redirect()->back()->with('pi_id',$pi_id);
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
