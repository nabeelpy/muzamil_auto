<?php

namespace App\Http\Controllers;

use App\Models\JobHoldModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:part-registration-list', ['only' => ['index','show']]);
        $this->middleware('permission:part-registration-create', ['only' => ['create','store']]);
        $this->middleware('permission:part-registration-edit', ['only' => ['edit','update']]);
    }



    public function index(Request $request)
    {
        $datas = PartsModel::all();

        $datas = DB::table('parts')
            ->leftJoin('users', 'users.id','=', 'parts.par_user_id')
        ->orderBy('par_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('parts.par_name', 'like', '%' . $request->job_no . '%');
        }

        if (isset($request->from_date)) {
            $query->whereDate('parts.par_created_at', '>=', $request->from_date);
        }
        if (isset($request->to_date)) {
            $query->whereDate('parts.par_created_at', '<=', $request->to_date);
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('parts.par_created_at', '>=', $request->from_date)
                ->whereDate('parts.par_created_at', '<=', $request->to_date);
        }

        $query = $query->get();

        return view('part_registration/part_registration_list', compact( 'job_no',  'from_date', 'to_date','query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('part_registration/add_part_registration');
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

            $this->validation($request);

            $auth = Auth::user();
            $jh = new PartsModel();
            $jh->par_name = $request->part_name;
            $jh->par_purchase_price = $request->purchase_price;
            $jh->par_bottom_price = $request->bottom_price;
            $jh->par_sale_price = $request->retail_price;
//            $jh->par_total_qty = $request->qty;
            $jh->par_total_qty = 0;
            $jh->par_status = "Created";

            $jh->par_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jh';
            $prfx = 'par';
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


//        add stock data
            $stock = new StockModel();
            $stock->sto_par_id = $jh->par_id;
            $stock->sto_user_id = $auth->id;
            $stock->sto_type = "Created";
            $stock->sto_type_id = $jh->par_id;
            $stock->sto_in = 0;
            $stock->sto_total = 0;
            $stock->save();

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
        $part = PartsModel::where('par_id','=',$id)->first();
        return view('part_registration/edit_part_registration',compact('part'));
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
            $part = PartsModel::where('par_id', '=', $id)->first();
            $part->par_name = $request->part_name;
            $part->par_purchase_price = $request->purchase_price;
            $part->par_bottom_price = $request->bottom_price;
            $part->par_sale_price = $request->retail_price;

            $part->par_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'part';
            $prfx = 'par';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

//        $part->bra_created_at=Carbon::now()->toDateTimeString();
//        $part->bra_updated_at=$auth->id;
            $part->save();
        });
        return redirect()->route('part_registration.index')->with('success', 'Successfully Updated');

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

    public function validation($request)
    {
        return $this->validate($request,[
            'part_name' => ['required', 'string','unique:parts,par_name'],
            'purchase_price' => 'required',
            'bottom_price' => 'required',
            'retail_price' => 'required',

        ]);

    }
}
