<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\JobCloseModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:client-list', ['only' => ['index']]);
        $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
    }




    public function index(Request $request)
    {
        $datas = ClientModel::all();
        $datas = DB::table('client')
            ->leftJoin('users', 'users.id','=', 'client.cli_user_id')
            ->orderBy('cli_id','Desc');

        $search = $request->search;
        $query = $datas;

        if (isset($request->search)) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('client.cli_name', 'like', '%' . $request->search . '%');
                $query->orWhere('client.cli_number', 'like', '%' . $request->search . '%');
            });
        }

        $query = $query->get();

        return view('edit_client/edit_client_list', compact( 'search',  'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edit_client/add_edit_client');
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
        $jcr = new ClientModel();
        $jcr->cli_name=$request->job_close_reason;
        $jcr->cli_number=$request->select_job;
        $jcr->cli_address=$request->client_address;
        $jcr->cli_remarks=$request->remarks;
        $jcr->cli_user_id=$auth->id;


        // coding from shahzaib start
        $tbl_var_name = 'jcr';
        $prfx = 'cli';
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
        $client = ClientModel::where('cli_id','=',$id)->first();
        return view('edit_client/edit_client',compact('client'));
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
            $client = ClientModel::where('cli_id', '=', $id)->first();

            $client->cli_number = $request->client_number;
            $client->cli_name = $request->client_name;
            $client->cli_address = $request->client_address;
            $client->cli_remarks = $request->remarks;
            $client->cli_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'client';
            $prfx = 'cli';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $client->save();
        });
        return redirect()->route('edit_client.index')->with('success', 'Successfully Updated');
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
