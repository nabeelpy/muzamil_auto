<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\CashReciptVoucherModel;
use App\Models\Category;
use App\Models\ModelTable;
use App\Models\PartsModel;
use App\Models\ProductLoss;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashReceiptVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:cash-receipt-voucher-list', ['only' => ['index','show']]);
        $this->middleware('permission:cash-receipt-voucher-create', ['only' => ['create','store']]);
    }


    public function index(Request $request)
    {
//        $datas = ModelTable::all();
//        $brands = Brand::all();
//        $categorys = Category::all();


        $datas = DB::table('cash_receipt_voucher')
            ->leftJoin('users', 'users.id','=', 'cash_receipt_voucher.jrv_user_id')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'cash_receipt_voucher.jrv_cash_account')
            ->orderBy('jrv_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('cash_account.ca_name', 'like', '%' . $request->job_no . '%');
        }



        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('cash_receipt_voucher.jrv_created_at', '>=', $request->from_date)
                ->whereDate('cash_receipt_voucher.jrv_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('cash_receipt_voucher.jrv_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('cash_receipt_voucher.jrv_created_at', '=', $request->to_date);
        }

        $query = $query->get();

        return view('cash_receipt_voucher/cash_receipt_voucher_list', compact( 'job_no', 'from_date','to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cash = CashAccountModel::all();

        return view('cash_receipt_voucher/add_cash_receipt_voucher',compact('cash'));
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
            'cash_account' => 'required',
            'received_by' => 'required',
            'remarks' => 'required',
            'amount' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use( $request ) {
            $auth = Auth::user();
            $crv = new CashReciptVoucherModel();
            $crv->jrv_cash_account = $request->cash_account;
            $crv->jrv_amount = $request->amount;
            $crv->jrv_remarks = $request->remarks;
            $crv->jrv_user_id = $auth->id;
            $crv->jrv_recieved_by = $request->received_by;

            // coding from shahzaib start
            $tbl_var_name = 'crv';
            $prfx = 'jrv';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

//        $crv->bra_created_at=Carbon::now()->toDateTimeString();
//        $crv->bra_updated_at=$auth->id;
            $crv->save();


//        store in parts table
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
            $cash_book->cb_ca_id = $crv->jrv_cash_account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Cash_Receipt";
            $cash_book->cb_type_id = $crv->jrv_id;
            $cash_book->cb_in = $request->amount;
            $cash_book->cb_total = $new_qty;
            $cash_book->save();
        });
        return redirect()->back()->with('success', 'Successfully Saved');
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
