<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\EmployeeRegistrationModel;
use App\Models\Technician;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:employee-list', ['only' => ['index','show']]);
        $this->middleware('permission:employee-create', ['only' => ['create','store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
    }


    public function index(Request $request)
    {
        $datas = User:: orderBy('id','Desc');
//        $datas = DB::table('users')
//        ->orderBy('id','Desc');


        $search = $request->search;
        $login_status = $request->login_status;
        $name = $request->name;
        $emp_status = $request->emp_status;
        $tech_status = $request->tech_status;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas
            ->where('id','!=',1)
        ;

        if (isset($request->name)) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('users.name', 'like', '%' . $request->name . '%');
                $query->orWhere('users.f_name', 'like', '%' . $request->name . '%');
                $query->orWhere('users.email', 'like', '%' . $request->name . '%');
                $query->orWhere('users.number', 'like', '%' . $request->name . '%');
            });
        }

        if (isset($request->from_date)) {
            $query->whereDate('users.created_at', '>=', $request->from_date);
        }
        if (isset($role)) {
            $query->where('users.role',  $request->role );
//            dd($query);
        }
//        if (isset($name)) {
//            $query->where('users.name',  $request->name );
////            dd($query);
//        }
        if (isset($emp_status)) {
            $query->where('users.employee_status',  $request->emp_status );
//            dd($query);
        }
        if (isset($login_status)) {
            $query->where('users.login_status',  $request->login_status );
//            dd($query);
        }
        if (isset($tech_status)) {
            $query->where('users.work_status',  $request->tech_status );
//            dd($query);
        }
        if (isset($request->to_date)) {
            $query->whereDate('users.created_at', '<=', $request->to_date);
        }

        if (isset($request->from_visit_search)) {
            $query->where('users.number_of_visit', '>=', $request->from_visit_search);
        }
        if (isset($request->to_visit_search)) {
            $query->where('users.number_of_visit', '<=', $request->to_visit_search);
        }



        if (isset($request->from_avg_rating_search)) {
            $query->where('users.average_rating', '>=', $request->from_avg_rating_search);
        }
        if (isset($request->to_avg_rating_search)) {
            $query->where('users.average_rating', '<=', $request->to_avg_rating_search);
        }

        $query = $query->get();



        return view('employee_registration/employee_registration_list', compact( 'search', 'from_date', 'to_date', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $roles = Role::pluck('name','name')->all();
        $roles = Role::all();
        return view('employee_registration/add_employee_registration',compact('roles'));
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

            $this->validation($request);


            $status = $request->log_status;
            $var_status = (int)$status;

            $employee_status = $request->emp_status;
            $var_statuss = (int)$employee_status;

            $work_status = $request->work_status;
            $var_work_status = (int)$work_status;

            $auth = Auth::user();
            $EmployeeRegistration = new User();
            $EmployeeRegistration->name = $request->name;
            $EmployeeRegistration->f_name = $request->father_name;
            $EmployeeRegistration->address = $request->address;
            $EmployeeRegistration->password = bcrypt($request->password);
            $EmployeeRegistration->confirm_password = bcrypt($request->confirm_password);
        $EmployeeRegistration->login_status=$var_status;
            $EmployeeRegistration->gender = $request->gender;
            $EmployeeRegistration->work_status = $var_work_status;
            $EmployeeRegistration->email = $request->email;
            $EmployeeRegistration->employee_status = $var_statuss;
            $EmployeeRegistration->number = $request->number;
            $EmployeeRegistration->cnic = $request->cnic;
            $EmployeeRegistration->role = $request->roles;


            // coding from shahzaib start
            $tbl_var_name = 'EmployeeRegistration';
            $prfx = '';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . 'browser_info';
            $ip_col = $prfx . 'ip_address';
            $updt_date_col = $prfx . 'updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now("GMT+5");
            // coding from shahzaib end


//            roles
            $EmployeeRegistration->save();
            $EmployeeRegistration->assignRole($request->input('roles'));


//            Technician register
//            $this->validation($request);

            $auth = Auth::user();

//            dd($var_statuss,$var_work_status);

            $technician = new Technician();
            $technician->tech_name = $request->name;
            $technician->tech_user_id = $EmployeeRegistration->id;
            $technician->status = $var_statuss;
            $technician->tech_status = $var_work_status;

            // coding from shahzaib start
            $tbl_var_name = 'technician';
            $prfx = 'tech';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

//        return $brwsr_rslt;

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $technician->save();



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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->first();
//        $userRole = $user->roles;


//        dd($roles,$userRole,$user);
//        dd($roles,$userRole->id);
//        $userRole = $user->roles->pluck('name','name')->all();
        $employee_registration = EmployeeRegistrationModel::where('id','=',$id)->first();
        return view('employee_registration/edit_employee_registration',compact('employee_registration','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        DB::transaction(function () use( $request ,$id) {
            $auth = Auth::user();
            $employee_registration = User::where('id', '=', $id)->first();
        $status = $request->log_status;
        $var_status = (int)$status;

            $employee_status = $request->emp_status;
            $var_statuss = (int)$employee_status;

            $work_status = $request->work_status;
            $var_work_status = (int)$work_status;


            $employee_registration->name = $request->name;
            $employee_registration->f_name = $request->father_name;
            $employee_registration->address = $request->address;
//            $employee_registration->password = bcrypt($request->password);
            $employee_registration->confirm_password = bcrypt($request->confirm_password);
        $employee_registration->login_status=$var_status;
            $employee_registration->gender = $request->gender;
            $employee_registration->work_status = $var_work_status;
//            $employee_registration->email = $request->email;
            $employee_registration->employee_status = $var_statuss;
            $employee_registration->number = $request->number;
            $employee_registration->cnic = $request->cnic;
            $employee_registration->role = $request->role;


            // coding from shahzaib start
            $tbl_var_name = 'employee_registration';
            $prfx = '';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . 'browser_info';
            $ip_col = $prfx . 'ip_address';
            $updt_date_col = $prfx . 'updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end


            $employee_registration->save();





            //            Technician register
//            $this->validation($request);

            $auth = Auth::user();

//            dd($var_statuss,$var_work_status);

            $technician = Technician::where('tech_user_id', '=', $employee_registration->id)->first();

            $technician->tech_name = $request->name;
            $technician->tech_user_id = $employee_registration->id;
            $technician->status = $var_statuss;
            $technician->tech_status = $var_work_status;

            // coding from shahzaib start
            $tbl_var_name = 'technician';
            $prfx = 'tech';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

//        return $brwsr_rslt;

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $technician->save();



            //            roles
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $employee_registration->assignRole($request->input('roles'));

        });
        return redirect()->route('employee_registration.index')->with('success', 'Successfully Updated');
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
            'email' => ['nullable', 'string','unique:users,email'],
            'name' => ['required', 'string','unique:users,name'],
        ]);

    }


}
