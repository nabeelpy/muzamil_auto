<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitReportController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:profit-report', ['only' => ['index','show']]);
    }


    public function index(Request $request)
    {

        $datas = DB::table('job_information')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_id','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=', 'job_issue_to_technician.jitt_technician')
            ->orderBy('ji_id','Desc');
//            ->leftJoin('issue_parts_to_job', 'job_information.ji_id','=', 'issue_parts_to_job.iptj_job_no');
//            ->leftJoin('issue_parts_to_job_items', 'issue_parts_to_job_items.iptji_iptj_id','=', 'issue_parts_to_job.iptj_id')
//            ->leftJoin('parts', 'parts.par_id','=', 'issue_parts_to_job_items.iptji_parts');



        $issue = DB::table('job_information')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_id','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=', 'job_issue_to_technician.jitt_technician')
            ->leftJoin('issue_parts_to_job', 'job_information.ji_id','=', 'issue_parts_to_job.iptj_job_no')
            ->leftJoin('issue_parts_to_job_items', 'issue_parts_to_job_items.iptji_iptj_id','=', 'issue_parts_to_job.iptj_id')
            ->leftJoin('parts', 'parts.par_id','=', 'issue_parts_to_job_items.iptji_parts')
            ->select('ji_id',DB::raw("SUM(iptji_amount) as total_issue"))->groupBy('ji_id')->where('iptj_status','=','Issued')
            ->orderBy('ji_id','Desc')
            ->get();

        $retured = DB::table('job_information')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_id','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=', 'job_issue_to_technician.jitt_technician')
            ->leftJoin('issue_parts_to_job', 'job_information.ji_id','=', 'issue_parts_to_job.iptj_job_no')
            ->leftJoin('issue_parts_to_job_items', 'issue_parts_to_job_items.iptji_iptj_id','=', 'issue_parts_to_job.iptj_id')
            ->leftJoin('parts', 'parts.par_id','=', 'issue_parts_to_job_items.iptji_parts')
            ->orderBy('ji_id','Desc')
            ->select('ji_id',DB::raw("SUM(iptji_amount) as total_return"))->groupBy('ji_id')->where('iptj_status','=','Returned')->get();



//        $issue = $datas->select([DB::raw("SUM(iptji_amount) as total_amount")])->groupBy('ji_id')->where('iptj_status','=','Issued');
//        $retured = $datas->select([DB::raw("SUM(iptji_amount) as total_amount")])->groupBy('ji_id')->where('iptj_status','=','Returned');
//       $abc =  $datas->where('iptji_iptj_id','=',3)->get();//->select('ji_id',DB::raw("SUM(ji_estimated_cost) as cc"),DB::raw("SUM(iptji_qty * par_purchase_price) as total_qty"))->groupBy('ji_id')->get();
//        $datas->select(("par_purchase_price"));
//        dd($issue->get());
//        dd($retured);

        $query = $datas;


        $job_no = $request->job_no;
        $status = $request->status;
        $tech_name = $request->tech_name;
        $tech_number = $request->tech_number;
        $warranty = $request->warranty;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));




        if ($request->warranty == '0'){
//            dd($request->warranty);
            $query->whereNull('job_information.ji_warranty_status');
//            dd($query->get());

        }


        if (isset($request->warranty)) {
            $query->orWhere('job_information.ji_warranty_status', 'like', '%' . $request->warranty . '%');
        }

        if (isset($request->job_no)) {
            $query->orWhere('job_information.ji_id', 'like', '%' . $request->job_no . '%');
        }
        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        }
        if (isset($request->client_name)) {
            $query->orWhere('technician.tech_name', 'like', '%' . $request->client_name . '%');

        }

//        dd($query->get());


        if ((!empty($request->from_date)) && (!empty($request->to_date))) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=',$from_date)
                ->whereDate('job_information.ji_recieve_datetime', '<=',$to_date);
//            dd($query->get());

        } else if (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $to_date);
        }

        $query = $query->get();
//  dd($datas,$datass);



        return view('reports/Profit_Report', compact( 'job_no','status', 'from_date', 'to_date','warranty','query','issue','retured'));


    }
}
