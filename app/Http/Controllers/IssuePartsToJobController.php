<?php

namespace App\Http\Controllers;

use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IssuePartsToJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:issue-parts-to-job-list', ['only' => ['index','show']]);
        $this->middleware('permission:issue-parts-to-job-create', ['only' => ['create','store']]);
        $this->middleware('permission:issue-parts-to-job-edit', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        $datas = DB::table('issue_parts_to_job')
        ->leftJoin('job_information', 'job_information.ji_id','=', 'issue_parts_to_job.iptj_job_no')
        ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
        ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->orderBy('iptj_id','Desc');


        $job_no = $request->job_no;
        $status = $request->status;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('issue_parts_to_job.iptj_job_no', 'like', '%' . $request->job_no . '%');
        }

        if (isset($request->status)) {
            $query->orWhere('issue_parts_to_job.iptj_status', 'like', '%' . $request->status . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '>=', $request->from_date)
                ->whereDate('issue_parts_to_job.iptj_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '=', $request->to_date);
        }



        $query = $query->get();


        return view('issue_parts_to_job/issue_parts_to_job_list', compact( 'job_no','from_date', 'to_date', 'query', 'status'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = JobInformationModel::where("ji_job_status","=","Assign")->get();
        $parts = PartsModel::where("par_status","=","Opening")->get();

        return view('issue_parts_to_job/add_issue_parts_to_job', compact( 'jobs', 'parts'));
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
            'select_job' => 'required',
            'qty.*' => 'required|integer|min:1',
            'st_qty.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use( $request ) {
        $user = Auth::user();


        $requested_arrays = $request->parts;

        $issue_parts = new IssuePartsToJobModel();
        $issue_parts->iptj_user_id = $user->id;
        $issue_parts->iptj_job_no = $request->select_job;
        $issue_parts->iptj_remarks = $request->remarks;
        $issue_parts->iptj_status = 'Issued';

        $issue_parts->save();



        foreach ($requested_arrays as $index => $requested_array) {


            $part_rate = PartsModel::select('par_purchase_price')->where('par_id','=',$request->parts[$index])->first();

//            dd($part_rate['par_purchase_price']);
            $part_amount = $request->qty[$index] * $part_rate['par_purchase_price'];

            $issue_parts_items = new IssuePartsToJobItemsModel();
            $issue_parts_items->iptji_user_id = $user->id;
            $issue_parts_items->iptji_iptj_id = $issue_parts->iptj_id;
            $issue_parts_items->iptji_parts = $request->parts[$index];
            $issue_parts_items->iptji_qty = $request->qty[$index];
            $issue_parts_items->iptji_rate = $part_rate['par_purchase_price'];
            $issue_parts_items->iptji_amount = $part_amount;

            $issue_parts_items->save();





            //        update in parts table
            $pat = PartsModel::where("par_id","=", $request->parts[$index])->first();
            $pat->par_total_qty= $pat->par_total_qty - $request->qty[$index];
            $pat->save();



            //        add stock data
            $last_qty = StockModel::where("sto_par_id","=", $request->parts[$index])->OrderBy("sto_id",'DESC')->first();
            $new_qty = $last_qty->sto_total - $request->qty[$index];


            $stock = new StockModel();
            $stock->sto_par_id=$request->parts[$index];
            $stock->sto_user_id=$user->id;
            $stock->sto_job_id=$issue_parts->iptj_job_no;
            $stock->sto_type="Assign";
            $stock->sto_type_id=$issue_parts->iptj_id;
            $stock->sto_hold=$request->qty[$index];
            $stock->sto_hold_rate=$part_rate['par_purchase_price'];
            $stock->sto_hold_amount=$part_amount;
            $stock->sto_total=$new_qty;
            $stock->save();


        }
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
