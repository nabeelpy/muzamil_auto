<?php

namespace App\Http\Controllers;

use App\Models\JobCloseReasonModel;
use App\Models\JobHoldModel;
use App\Models\JobInformationModel;
use App\Models\JobReopenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobReOpenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-reopen-list', ['only' => ['index','show']]);
        $this->middleware('permission:job-reopen-create', ['only' => ['create','store']]);
    }


    public function index(Request $request)
    {
        $datas = JobReopenModel::all();

        $datas = DB::table('job_reopen')
            ->leftJoin('users', 'users.id','=', 'job_reopen.jro_user_id')
            ->leftJoin('job_information', 'job_information.ji_id','=', 'job_reopen.jro_job_no')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->leftJoin('job_close_reason', 'job_close_reason.jcr_id','=', 'job_reopen.jro_reason')
            ->orderBy('jro_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('job_reopen.jro_job_no', 'like', '%' . $request->job_no . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('job_reopen.jro_created_at', '>=', $request->from_date)
                ->whereDate('job_reopen.jro_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('job_reopen.jro_created_at', '>=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('job_reopen.jro_created_at', '<=', $request->to_date);
        }



        $query = $query->get();


        return view('job_re_open/job_re_open_list', compact( 'job_no', 'from_date', 'to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reasons = JobCloseReasonModel::all();
        $job_num = JobInformationModel::where("ji_job_status","=","Hold")->get();


        return view('job_re_open/add_job_re_open', compact('job_num','reasons'));

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

            $auth = Auth::user();
            $jh = new JobReopenModel();
            $jh->jro_job_no = $request->select_job;
            $jh->jro_reason = $request->select_reason;
            $jh->jro_remarks = $request->remarks;
            $jh->jro_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jh';
            $prfx = 'jro';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

//        $jh->bra_created_at=Carbon::now()->toDateTimeString();
//        $jh->bra_updated_at=$auth->id;
            $jh->save();
        });
        jobInformationModel::where("ji_id","=", $request->select_job)->update(['ji_job_status'=>"Assign"]);

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
        $job_num = JobInformationModel::all();

        $job_re_open = JobReopenModel::where('jro_id','=',$id)->first();
        return view('job_re_open /edit_job_re_open ',compact('job_re_open','job_num'));
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
            $job_re_open = JobReopenModel::where('jro_id', '=', $id)->first();
            $job_re_open->jro_job_no = $request->select_job;
            $job_re_open->jro_reason = $request->reason;
            $job_re_open->jro_remarks = $request->remarks;
            $job_re_open->jro_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jh';
            $prfx = 'jro';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_re_open->save();
        });
        return redirect()->route('job_re_open.index')->with('success', 'Successfully Updated');
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
