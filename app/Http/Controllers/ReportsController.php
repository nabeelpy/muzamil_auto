<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:time-report', ['only' => ['index','show']]);
    }


    public function index(Request $request)
    {

        $datas = DB::table('job_information')
            ->leftJoin('users', 'users.id','=', 'job_information.ji_user_id')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
            ->leftJoin('job_close', 'job_close.jc_job_no','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->where('ji_job_status','!=',"Pending")
            ->orderBy('ji_id','Desc');


        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id','Desc')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id','Desc')
            ->get();



        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));

        $query = $datas;


        if (isset($request->warranty)) {
            $query->orWhere('job_information.ji_warranty_status', 'like', '%' . $request->warranty . '%');
        }


        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', 'like', '%' . $request->status. '%');
        }
        if (isset($request->job_no)) {
            $query->where('job_information.ji_id', '=', $request->job_no);
        }
        if (isset($request->client_name)) {
            $query->where('technician.tech_name', 'like', '%' . $request->client_name. '%');
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




        return view('reports/technician_job_info_report', compact( 'job_no','status','client_name','client_number', 'from_date', 'to_date', 'query','complain_items','accessory_items','warranty'));


    }
}
