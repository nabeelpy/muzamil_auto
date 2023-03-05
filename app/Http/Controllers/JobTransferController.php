<?php

namespace App\Http\Controllers;

use App\Models\JobCloseModel;
use App\Models\JobCloseReasonModel;
use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\JobTransfer;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-transfer-list', ['only' => ['index','show']]);
        $this->middleware('permission:job-transfer-create', ['only' => ['create','store']]);
    }


    public function index(Request $request)
    {
        $datas = JobTransfer::all();

        $datas = DB::table('job_transfer')
            ->leftJoin('users', 'users.id','=', 'job_transfer.jt_user_id')
            ->leftJoin('technician as old_tec', 'old_tec.tech_id','=', 'job_transfer.jt_technician')
            ->leftJoin('technician as new_tec', 'new_tec.tech_id','=', 'job_transfer.jt_new_technician')
            ->select('job_transfer.*','old_tec.tech_name as old_name','new_tec.tech_name as new_name')
            ->orderBy('jt_id','Desc');


        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('job_transfer.jt_job_no', 'like', '%' . $request->job_no . '%');
        }

        if (isset($request->status)) {
            $query->orWhere('job_transfer.jt_status', 'like', '%' . $request->status . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('job_transfer.jt_created_at', '>=', $request->from_date)
                ->whereDate('job_transfer.jt_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('job_transfer.jt_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('job_transfer.jt_created_at', '=', $request->to_date);
        }



        $query = $query->get();

        return view('job_transfer/job_transfer_list', compact( 'job_no', 'from_date', 'to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job_num = JobInformationModel::where("ji_job_status","=","Assign")->get();
        $old_technicians = Technician::where("status",'=','1')->where("tech_status",'=','1')->get();
        $new_technicians = Technician::where("status",'=','1')->where("tech_status",'=','1')->get();



        return view('job_transfer/add_job_transfer', compact('job_num','old_technicians','new_technicians'));

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

//        dd($request->all());

            $auth = Auth::user();
            $jt = new JobTransfer();
            $jt->jt_job_no = $request->job_no;
            $jt->jt_technician = $request->old_tech;
            $jt->jt_new_technician = $request->new_tech;
            $jt->jt_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jt';
            $prfx = 'jt';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $jt->save();
            JobIssueToTechnicianModel::where("jitt_job_no","=", $jt->jt_job_no)->update(['jitt_technician'=>$jt->jt_new_technician]);

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
        $job_num = JobInformationModel::where("ji_job_status","=","Assign")->get();
        $old_technicians = Technician::all();
        $new_technicians = Technician::all();

        $job_transfer = JobTransfer::where('jt_id','=',$id)->first();
        return view('job_transfer/edit_job_transfer',compact('job_transfer','job_num','old_technicians','new_technicians'));
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
            $job_transfer = new JobTransfer();
            $job_transfer->jt_job_no = $request->job_no;
            $job_transfer->jt_technician = $request->old_tech;
            $job_transfer->jt_new_technician = $request->new_tech;
            $job_transfer->jt_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'job_transfer';
            $prfx = 'jt';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_transfer->save();
        });
        return redirect()->route('job_transfer.index')->with('success','Successfully Updated');
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
