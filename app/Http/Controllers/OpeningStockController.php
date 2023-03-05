<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpeningStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:stock-list', ['only' => ['index','show']]);
    }



    public function index(Request $request)
    {


        $datas = DB::table('stock')
            ->leftJoin('parts', 'parts.par_id','=', 'stock.sto_par_id')
            ->orderBy('sto_id','Desc');



        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('stock.sto_job_id', 'like', '%' . $request->job_no . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('stock.sto_created_at', '>=', $request->from_date)
                ->whereDate('stock.sto_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('stock.sto_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('stock.sto_created_at', '=', $request->to_date);
        }



        $query = $query->get();



        return view('opening_stock/stock_list', compact( 'job_no', 'from_date', 'to_date', 'query'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opening_stock/add_opening_stock');
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
            // coding from shahzaib start
            $tbl_var_name = 'os';
            $prfx = 'mod';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end
        });
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
