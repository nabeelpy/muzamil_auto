<?php

namespace App\Http\Controllers;

use App\Models\CompanyModel;
use Faker\Provider\ar_JO\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function company_info(){
        $company_info = CompanyModel::first();
        return view('company_info.company_info',compact('company_info'));
    }

    function store_company_info(Request $request){
        $company_info = CompanyModel::first();
        $company_info->com_name = $request->name;
        $company_info->com_ceo = $request->ceo;
        $company_info->com_number = $request->number;
        $company_info->com_services = $request->services;
        $company_info->com_address = $request->address;
        $company_info->com_instructions = $request->instructions;
        $company_info->com_complain = $request->cnumber;
        $company_info->save();

        return redirect()->back()->with('success','Successfully Saved Company Info');
    }
}
