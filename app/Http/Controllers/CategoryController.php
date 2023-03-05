<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ClientModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:category-list', ['only' => ['category_list']]);
        $this->middleware('permission:category-create', ['only' => ['add_category','store_category']]);
        $this->middleware('permission:category-edit', ['only' => ['edit_category','update_category']]);
    }

    public function add_category()
    {
        $brands = Brand::all();

        return view('category/add_category', compact('brands'));
    }

    public function store_category(Request $request)
    {

        DB::transaction(function () use( $request ) {

//        $this->category_validation($request);
            $this->validation($request);


            $auth = Auth::user();

            $category = new Category();
            $category->cat_name = $request->cat_name;
            $category->cat_bra_id = $request->bra_name;
            $category->cat_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'category';
            $prfx = 'cat';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $category->save();
//        return redirect()->back()->with('success','Successfully Saved');
        });
        return redirect()->back()->with('success','Successfully Saved');


    }

//    public function category_validation($request)
//    {
//        return $this->validate($request,[
//           'cat_name' => ['required', 'string','cat_name,NULL,cat_id,cat_bra_id,'.$request->bra_name],
//
//        ]);
//
//    }



    public function category_list(Request $request)
    {
        $datas = Category::all();
        $brands = Brand::all();

        $datas = DB::table('categories')
            ->leftJoin('users', 'users.id','=', 'categories.cat_user_id')
            ->leftJoin('brands', 'brands.bra_id','=', 'categories.cat_bra_id')
            ->orderBy('cat_id','Desc');


        $search_category = $request->search_category;
        $bra_name = $request->bra_name;
        $query = $datas;

        if (isset($request->search_category)) {
                $query->orWhere('categories.cat_name', 'like', '%' . $request->search_category . '%');
        }

        if (isset($request->bra_name)) {
                $query->orWhere('brands.bra_name', 'like', '%' . $request->bra_name . '%');
        }

        $query = $query->get();


        return view('category/category_list', compact( 'bra_name', 'search_category', 'query', 'brands'));
    }


    public function client_exist(Request $request)
    {
//        dd(12);
        $client_no=$request->number;
        $data = ClientModel::where('cli_number','=',$client_no)->first();

        return response()->json($data);
    }

    public function edit_category($id)
    {
        $brands = Brand::all();
        $category = Category::where('cat_id','=',$id)->first();
        return view('category/edit_category',compact('category','brands'));

    }
    public function update_category(Request $request, $id)
    {
        DB::transaction(function () use( $request , $id) {
            $auth = \Illuminate\Support\Facades\Auth::user();
            $category = Category::where('cat_id', '=', $id)->first();

            $category->cat_name = $request->cat_name;
            $category->cat_bra_id = $request->bra_name;

            $category->cat_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'category';
            $prfx = 'cat';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $category->save();
        });
        return redirect()->route('category_list')->with('success', 'Successfully Updated');

    }


    public function validation($request)
    {
        return $this->validate($request,[
            'cat_name' => ['required', 'string','unique:categories,cat_name,NULL,cat_id,cat_bra_id,'.$request->bra_name],
        ]);

    }
}
