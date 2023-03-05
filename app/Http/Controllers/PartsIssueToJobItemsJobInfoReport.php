<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartsIssueToJobItemsJobInfoReport extends Controller
{


    function __construct()
    {
        $this->middleware('permission:issue-parts-report', ['only' => ['index','show']]);
    }

    public function index(Request $request)
    {

        $datas = DB::table('job_information')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_id','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=', 'job_issue_to_technician.jitt_technician')
            ->leftJoin('issue_parts_to_job', 'job_information.ji_id','=', 'issue_parts_to_job.iptj_job_no')
            ->leftJoin('issue_parts_to_job_items', 'issue_parts_to_job_items.iptji_iptj_id','=', 'issue_parts_to_job.iptj_id')
            ->leftJoin('parts', 'parts.par_id','=', 'issue_parts_to_job_items.iptji_parts')
            ->orderBy('ji_id','Desc');




        $query = $datas;


        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
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
        if (isset($request->client_name)) {
            $query->orWhere('technician.tech_name', 'like', '%' . $request->client_name . '%');
        }
        if (isset($request->status)) {
            $query->orWhere('job_information.ji_job_status', 'like', '%' . $request->status . '%');
        }


        if ((!empty($request->from_date)) && (!empty($request->to_date))) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=',$from_date)
                ->whereDate('job_information.ji_recieve_datetime', '<=',$to_date);
        } else if (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $to_date);
        }

        $query = $query->get();
//  dd($datas,$datass);



        return view('reports/Job_Info_Job_Issue_Parts_Items_Report', compact( 'job_no','status', 'from_date', 'to_date','warranty','query'));


    }
}
