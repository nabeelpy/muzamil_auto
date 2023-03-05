<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\ModelTable;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:model-list', ['only' => ['model_list']]);
        $this->middleware('permission:model-create', ['only' => ['add_model','store_model']]);
        $this->middleware('permission:model-edit', ['only' => ['edit_model','update_model']]);
    }


    public function add_model()
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('model/add_model', compact('brands','categories'));
    }
    public function model_list(Request $request)
    {
        $datas = ModelTable::all();
        $brands = Brand::all();
        $categorys = Category::all();


        $datas = DB::table('model_table')
            ->leftJoin('users', 'users.id','=', 'model_table.mod_user_id')
//            ->leftJoin('brands', 'brands.bra_id','=', 'categories.cat_bra_id')
            ->leftJoin('categories', 'categories.cat_id','=', 'model_table.mod_cat_id')
            ->leftJoin('brands', 'brands.bra_id','=', 'model_table.mod_bra_id')
            ->orderBy('mod_id','Desc');

        $search_category = $request->search_category;
        $bra_name = $request->bra_name;
        $search_model = $request->search_model;
        $query = $datas;

//        $search = $request->search;
//        $query = $datas;

        if (isset($request->search_category)) {
            $query->orWhere('categories.cat_name', 'like', '%' . $request->search_category . '%');
        }

        if (isset($request->bra_name)) {
            $query->orWhere('brands.bra_name', 'like', '%' . $request->bra_name . '%');
        }

        if (isset($request->search_model)) {
            $query->orWhere('model_table.mod_name', 'like', '%' . $request->search_model . '%');
        }

        $query = $query->get();

        return view('model/model_list', compact( 'bra_name', 'search_category', 'query', 'brands', 'categorys', 'search_model'));
    }
    public function store_model(Request $request)
    {
        DB::transaction(function () use( $request ) {
            $this->validation($request);

            $auth = Auth::user();
            $model = new ModelTable();
            $model->mod_bra_id = $request->bra_name;
            $model->mod_cat_id = $request->cat_name;
            $model->mod_name = $request->mod_name;

            // coding from shahzaib start
            $tbl_var_name = 'model';
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

            $model->mod_user_id = $auth->id;
            $model->save();
        });
        return redirect()->back()->with('success','Successfully Saved');
    }






    public function update_model(Request $request, $id)
    {
        DB::transaction(function () use( $request ,$id) {
            $auth = Auth::user();
            $model = ModelTable::where('mod_id', '=', $id)->first();

            $model->mod_bra_id = $request->bra_name;
            $model->mod_cat_id = $request->cat_name;
            $model->mod_name = $request->mod_name;

            $model->mod_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'model';
            $prfx = 'mod';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $model->save();
        });
        return redirect()->route('model_list')->with('success', 'Successfully Updated');

    }

    public function edit_model($id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $model = ModelTable::where('mod_id','=',$id)->first();
        return view('model/edit_model',compact('model','brands','categories'));
    }












//    extra

    public function get_category(Request $request)
    {
        $bra_name_id = $request->bra_name_id;

        $cats = Category::where('cat_bra_id', $bra_name_id)->orderBy('cat_name', 'ASC')->get();

        return response()->json($cats);
    }

    public function get_model(Request $request)
    {
        $cat_name_id = $request->cat_name_id;

        $cats = ModelTable::where('mod_cat_id', $cat_name_id)->orderBy('mod_name', 'ASC')->get();

        return response()->json($cats);
    }

    public function get_old_technision(Request $request)
    {
        $bra_name_id = $request->bra_name_id;

        $cats = DB::table('job_issue_to_technician')
            ->leftJoin('technician', 'technician.tech_id','=', 'job_issue_to_technician.jitt_technician')
            ->where('jitt_job_no', $bra_name_id)->get();

//        $cats = JobIssueToTechnicianModel::where('mod_cat_id', $bra_name_id)->orderBy('mod_name', 'ASC')->get();

        return response()->json($cats);
    }


    public function validation($request)
    {
        return $this->validate($request,[
            'mod_name' => ['required', 'string','unique:model_table,mod_name,NULL,mod_id,mod_cat_id,'.$request->cat_name.',mod_bra_id,'.$request->bra_name],
        ]);

    }
}
