<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\JobCloseModel;
use App\Models\JobCloseReasonModel;
use App\Models\JobInformationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobCloseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:job-close-list', ['only' => ['index','show']]);
        $this->middleware('permission:job-close-create', ['only' => ['create','store']]);
    }



    public function index(Request $request)
    {

        $datas = JobCloseModel::all();

        $datas = DB::table('job_close')
            ->leftJoin('users', 'users.id','=', 'job_close.jc_user_id')
            ->leftJoin('job_information', 'job_information.ji_id','=', 'job_close.jc_job_no')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->leftJoin('job_close_reason', 'job_close_reason.jcr_id','=', 'job_close.jc_reason')
            ->orderBy('jc_id','Desc');


        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('job_close.jc_job_no', 'like', '%' . $request->job_no . '%');
        }


        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('job_close.jc_created_at', '>=', $request->from_date)
                ->whereDate('job_close.jc_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('job_close.jc_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('job_close.jc_created_at', '=', $request->to_date);
        }


        $query = $query->get();



        return view('job_close/job_close_list', compact( 'job_no', 'from_date', 'to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        $reasons = JobCloseReasonModel::all();
        $select_job = JobInformationModel::where("ji_job_status","=","Assign")->get();


        return view('job_close/add_job_close', compact('select_job','reasons'));
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

        DB::transaction(function () use( $request ) {

            $auth = Auth::user();
            $jcr = new JobCloseModel();
            $jcr->jc_reason = $request->job_close_reason;
            $jcr->jc_job_no = $request->select_job;
            $jcr->jc_remarks = $request->remarks;
            $jcr->jc_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jcr';
            $prfx = 'jc';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end


//        $jcr->bra_created_at=Carbon::now()->toDateTimeString();
//        $jcr->bra_updated_at=$auth->id;
            $jcr->save();
        });
        jobInformationModel::where("ji_id","=", $request->select_job)->update(['ji_job_status'=>"Close"]);


        });

        return redirect()->back()->with('success', 'Successfully Saved');

//        return redirect()->back()->with('success','Successfully Saved');
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
        $reasons = JobCloseReasonModel::all();
        $select_job = JobInformationModel::all();

        $job_close = JobCloseModel::where('jc_id','=',$id)->first();
        return view('job_close/edit_job_close',compact('job_close','reasons','select_job'));
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
            $job_close = JobCloseModel::where('jc_id', '=', $id)->first();

            $job_close->jc_reason = $request->job_close_reason;
            $job_close->jc_job_no = $request->select_job;
            $job_close->jc_remarks = $request->remarks;
            $job_close->jc_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'jcr';
            $prfx = 'jc';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_close->save();
        });
        return redirect()->route('job_close.index')->with('success', 'Successfully Updated');
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
