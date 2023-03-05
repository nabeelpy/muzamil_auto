<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobInfoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:detail-job-information-list', ['only' => ['index','show']]);
    }


    public function index(Request $request)
    {


        $ar = json_decode($request->array);
        $job_no = (!isset($request->job_no) && empty($request->job_no)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->job_no;
        $status = (!isset($request->status) && empty($request->status)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->status;
        $warranty = (!isset($request->warranty) && empty($request->warranty)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->warranty;
        $client_name = (!isset($request->client_name) && empty($request->client_name)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->client_name;
        $client_number = (!isset($request->client_number) && empty($request->client_number)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->client_number;
        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[6]->{'value'} : '') : $request->from_date;
        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[7]->{'value'} : '') : $request->to_date;

        $search_by_user = (isset($request->search_by_user) && !empty($request->search_by_user)) ? $request->search_by_user : '';
        $prnt_page_dir = 'modal_views.job_report';
        $pge_title = 'Job Information Report';
        $srch_fltr = [];
        array_push($srch_fltr, $job_no, $status, $warranty, $client_name, $client_number, $from_date, $to_date);

//        dd($request->array);


        $datas = DB::table('job_information')
            ->leftJoin('users', 'users.id','=', 'job_information.ji_user_id')
            ->leftJoin('vendor', 'vendor.vendor_id','=', 'job_information.ji_vendor')
            ->leftJoin('brands', 'brands.bra_id','=', 'job_information.ji_bra_id')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->leftJoin('categories', 'categories.cat_id','=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id','=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id','=', 'job_information.ji_cli_id')
            ->orderBy('ji_id','Desc');

//
        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Complain")
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', "Accessory")
            ->groupBy('jii_ji_id')
            ->get();



        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;
        $tech_name = $request->tech_name;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));

        $query = $datas;


        if ($request->warranty == '0'){
//            dd($request->warranty);
            $query->whereNull('job_information.ji_warranty_status');
//            dd($query->get());

        }

        if (isset($request->tech_name)) {
            $query->orWhere('technician.tech_name', 'like', '%' . $request->tech_name . '%');
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
            $query->orWhere('client.cli_name', 'like', '%' . $request->client_name . '%');
        }
        if (isset($request->client_number)) {
            $query->orWhere('client.cli_number', 'like', '%' . $request->client_number . '%');
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



//        if (isset($request->array) && !empty($request->array)) {
        if ($request->pdf_download == "1") {

            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('query', 'pge_title','complain_items', 'accessory_items'));

            return $pdf->stream($pge_title . '_x.pdf');

        } else {
            return view('job_info/add_job_info_list', compact('job_no', 'status', 'client_name', 'client_number', 'from_date', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty','tech_name'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
