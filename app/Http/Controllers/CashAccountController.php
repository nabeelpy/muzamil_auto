<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\CashPaymentVoucherModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
        $this->middleware('permission:cash-account-list', ['only' => ['index','show']]);
        $this->middleware('permission:cash-account-create', ['only' => ['create','store']]);
    }


    public function index(Request $request)
    {
        $datas = CashAccountModel::all();



        $datas = DB::table('cash_account')
            ->leftJoin('users', 'users.id','=', 'cash_account.ca_user_id')
            ->orderBy('ca_id','Desc');

        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('job_information.ji_id', 'like', '%' . $request->job_no . '%');
        }
        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        }
        if (isset($request->client_name)) {
            $query->orWhere('client.cli_name', 'like', '%' . $request->client_name . '%');
        }
        if (isset($request->client_number)) {
            $query->orWhere('client.cli_number', 'like', '%' . $request->client_number . '%');
        }
        if (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $request->from_date);
        }
        if (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '<=', $request->to_date);
        }



        $query = $query->get();


        return view('cash_account/cash_account_list', compact( 'job_no', 'from_date', 'to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash_account/add_cash_account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use( $request ) {
            // $this->validation($request);
            $this->validation($request);

            $auth = Auth::user();
            $pl = new CashAccountModel();
            $pl->ca_name = $request->cash_account;
            $pl->ca_balance = $request->opening_balance;

            $pl->ca_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'pl';
            $prfx = 'ca';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

//        return $brwsr_rslt;

            $pl->save();


            //        add cash book data
            $cash_book = new CashBookModel();
            $cash_book->cb_ca_id = $pl->ca_id;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->cb_type = "Opening_Stock";
            $cash_book->cb_type_id = $pl->ca_id;
            $cash_book->cb_in = $request->opening_balance;
            $cash_book->cb_total = $request->opening_balance;
            $cash_book->save();


        });


        return redirect()->back()->with('success','Successfully Saved');
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
        $cash_account = CashAccountModel::where('ca_id','=',$id)->first();
        return view('cash_account/edit_cash_account ',compact('cash_account'));
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
        DB::transaction(function () use( $request , $id) {
            $auth = Auth::user();
            $cash_account = CashAccountModel::where('ca_id', '=', $id)->first();
            $cash_account->ca_name = $request->cash_account;
            $cash_account->ca_balance = $request->opening_balance;

            $cash_account->ca_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'cash_account';
            $prfx = 'ca';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $cash_account->save();
        });
        return redirect()->route('cash_account.index')->with('success', 'Successfully Updated');

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


    public function validation($request)
    {
        return $this->validate($request,[
            'cash_account' => ['required', 'string','unique:cash_account,ca_name'],
            'opening_balance' => 'required',
        ]);

    }

}
