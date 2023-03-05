<?php

namespace App\Http\Controllers;

use App\Models\JobCloseReasonModel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobCloseReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
        $this->middleware('permission:job-lab-close-reason-list', ['only' => ['index']]);
        $this->middleware('permission:job-lab-close-reason-create', ['only' => ['create','store']]);
        $this->middleware('permission:job-lab-close-reason-edit', ['only' => ['edit','update']]);
    }


    public function index(Request $request)
    {
        $datas = JobCloseReasonModel::all();

        $datas = DB::table('job_close_reason')
            ->leftJoin('users', 'users.id','=', 'job_close_reason.jcr_user_id')
            ->orderBy('jcr_id','Desc')
            ->get();


        $query = $datas;

        return view('job_close_reason/job_close_reason_list', compact(  'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job_close_reason/add_job_close_reason');
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
//        $this->validation($request);

            $auth = Auth::user();
            $brand = new JobCloseReasonModel();
            $brand->jcr_name = $request->jcr_name;
            $brand->jcr_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'brand';
            $prfx = 'jcr';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $brand->save();
        });
        return redirect()->back()->with('success','Successfully Saved');
    }
    public function validation($request)
    {
        return $this->validate($request,[
//            'brand' => ['required', 'string','unique:brands,bra_name'],
        ]);

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
        $job_close_reason = JobCloseReasonModel::where('jcr_id','=',$id)->first();
        return view('job_close_reason/edit_job_close_reason',compact('job_close_reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        DB::transaction(function () use( $request ,$id) {
            $auth = Auth::user();
            $job_close_reason = JobCloseReasonModel::where('jcr_id', '=', $id)->first();

            $job_close_reason->jcr_name = $request->jcr_name;
            $job_close_reason->jcr_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'job_close_reason';
            $prfx = 'jcr';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $job_close_reason->save();
        });
        return redirect()->route('job_close_reason.index')->with('success','Successfully Updated');
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
