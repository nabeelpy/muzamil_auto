<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\JobCloseModel;
use App\Models\JobHoldModel;
use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\PartsModel;
use App\Models\SaleInvoiceForJobsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleInvoiceForJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
        $this->middleware('permission:sale-invoice-for-job-list', ['only' => ['index','show']]);
        $this->middleware('permission:sale-invoice-for-job-create', ['only' => ['create','store']]);
    }

    public function index(Request $request)
    {
//        $datas = SaleInvoiceForJobsModel::all();

        $datas = DB::table('sale_invoice_for_jobs')
            ->leftJoin('users', 'users.id','=', 'sale_invoice_for_jobs.sifj_user_id')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'sale_invoice_for_jobs.sifj_cash_account')
            ->orderBy('sifj_id','Desc');


        $job = $request->job;
        $invoice = $request->invoice;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;



        if (isset($request->invoice)) {
            $query->where('sale_invoice_for_jobs.sifj_id', '=', $request->invoice);
        }
        if (isset($request->job)) {
            $query->where('sale_invoice_for_jobs.sifj_job_no', '=', $request->job);
        }


        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '>=', $request->from_date)
                ->whereDate('sale_invoice_for_jobs.sifj_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '=', $request->to_date);
        }


        $query = $query->get();

        return view('sale_invoice/sale_invoice_for_jobs_list', compact( 'job', 'from_date', 'to_date', 'query','invoice'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cash_accounts = CashAccountModel::all();
        $job_number = JobInformationModel::where("ji_job_status","=","Close")
            ->orwhere("ji_job_status","=","Credit")
            ->get();

        $sale_invoice_for_jobs = SaleInvoiceForJobsModel::all();

        return view('sale_invoice/sale_invoice_for_jobs',compact('sale_invoice_for_jobs','job_number','cash_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        global $sifj_id;

        $this->validate($request, [
            'job_no' => 'required',
            'cash_account' => 'required',
            'amount' => 'required|integer|min:0',
            'estimated_cost' => 'required|integer|min:1',
            'remaining_estimated_cost' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use( $request, $sifj_id ) {
            $auth = Auth::user();
            $sale_invoice_for_jobs = new SaleInvoiceForJobsModel();
            $sale_invoice_for_jobs->sifj_job_no = $request->job_no;
            $sale_invoice_for_jobs->sifj_cash_account = $request->cash_account;
            $sale_invoice_for_jobs->sifj_amount_paid = $request->amount;
            $sale_invoice_for_jobs->sifj_real_estimated_cost = $request->real_estimated_cost;
            $sale_invoice_for_jobs->sifj_estimated_cost = $request->estimated_cost;
            $sale_invoice_for_jobs->sifj_remaining_cost = $request->remaining_estimated_cost;
            $sale_invoice_for_jobs->sifj_discount = $request->discount;
            $sale_invoice_for_jobs->sifj_remarks = $request->remarks;
            $sale_invoice_for_jobs->sifj_user_id = $auth->id;


            $t_amount_pay = $request->real_estimated_cost - $request->remaining_estimated_cost;

            // coding from shahzaib start
            $tbl_var_name = 'sale_invoice_for_jobs';
            $prfx = 'sifj';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $sale_invoice_for_jobs->save();


            if ($request->remaining_estimated_cost == 0) {
                //        update job information status
                jobInformationModel::where("ji_id", "=", $request->job_no)->update(['ji_job_status' => "Paid"]);
            } else {
//        update job information status
                jobInformationModel::where("ji_id", "=", $request->job_no)->update(['ji_job_status' => "Credit", 'ji_remaining' => $request->remaining_estimated_cost, 'ji_amount_pay' => $t_amount_pay]);
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
            $cash_book->cb_ca_id = $sale_invoice_for_jobs->sifj_cash_account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Job Invoice";
            $cash_book->cb_type_id = $sale_invoice_for_jobs->sifj_id;
//            $cash_book->cb_job_id = $sale_invoice_for_jobs->sifj_id;
            $cash_book->cb_job_id = $request->job_no;
            $cash_book->cb_in = $request->amount;
            $cash_book->cb_total = $new_qty;
            $cash_book->save();

            global $sifj_id;

            $sifj_id = $sale_invoice_for_jobs->sifj_id;



        });

//        dd($sifj_id);


        return redirect()->back()->with('sifj_id',$sifj_id);
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
        $cash_accounts = CashAccountModel::all();
        $job_number = JobInformationModel::all();
        $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('sifj_id','=',$id)->first();
        return view('sale_invoice/edit_sale_invoice_for_jobs',compact('sale_invoice_for_jobs','job_number','cash_accounts'));
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
        DB::transaction(function () use( $request ,$id) {

            $auth = Auth::user();
            $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('sifj_id', '=', $id)->first();
            $sale_invoice_for_jobs->sifj_job_no = $request->job_no;
            $sale_invoice_for_jobs->sifj_cash_account = $request->cash_account;
            $sale_invoice_for_jobs->sifj_amount_paid = $request->amount;
            $sale_invoice_for_jobs->sifj_estimated_cost = $request->estimated_cost;
            $sale_invoice_for_jobs->sifj_remaining_cost = $request->remaining_estimated_cost;
            $sale_invoice_for_jobs->sifj_remarks = $request->remarks;
            $sale_invoice_for_jobs->sifj_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'sale_invoice_for_jobs';
            $prfx = 'sifj';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $sale_invoice_for_jobs->save();
        });
        return redirect()->route('sale_invoice_for_jobs.index')->with('success', 'Successfully Updated');
//        return redirect()->back()->with('success','Successfully Saved');
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
