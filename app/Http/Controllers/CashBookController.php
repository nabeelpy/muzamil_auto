<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CashBookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashBookController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:cash-payment-voucher-list', ['only' => ['index','show']]);
        $this->middleware('permission:cash-payment-voucher-create', ['only' => ['create','store']]);
    }



    public function cash_book_list(Request $request)
    {

        $datas = DB::table('cash_book')
            ->leftJoin('cash_account', 'cash_account.ca_id','=', 'cash_book.cb_ca_id')
            ->orderBy('cb_id','Desc');




        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('cash_book.cb_job_id', 'like', '%' . $request->job_no . '%');
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('cash_book.cb_created_at', '>=', $request->from_date)
                ->whereDate('cash_book.cb_created_at', '<=', $request->to_date);
        }
        else if (isset($request->from_date)) {
            $query->whereDate('cash_book.cb_created_at', '=', $request->from_date);
        }
        else if (isset($request->to_date)) {
            $query->whereDate('cash_book.cb_created_at', '=', $request->to_date);
        }



        $query = $query->get();



        return view('cash_book/cash_book_list', compact( 'job_no','from_date', 'to_date', 'query'));



    }

}
