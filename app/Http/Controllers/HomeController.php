<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyIncomeCharte;
use App\Charts\MonthlyJobCharte;
use App\Charts\StockBarChart;
use App\Charts\StockChart;
use App\Charts\StockDonutChart;
use App\Models\CashBookModel;
use App\Models\JobInformationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Admin Dashboard', ['only' => ['admin_dashboard']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin_dashboard(MonthlyJobCharte $chart, MonthlyIncomeCharte $monthlyIncomeCharte, StockChart $stockChart, StockDonutChart $stockBarChart)
    {

        $current_date = Carbon::now('GMT+5')->format('Y-m-d');


        $profit = JobInformationModel::where("ji_created_at",">=",$current_date)
            ->select([DB::raw("SUM(ji_estimated_cost) as total_profit")])
            ->get();


        $jobs = JobInformationModel::where("ji_created_at",">=",$current_date)
            ->select([DB::raw("COUNT(ji_estimated_cost) as total_jobs")])
//            ->groupBy('id')
            ->get();

        $in = CashBookModel::where("cb_created_at",">=",$current_date)
            ->select([DB::raw("SUM(cb_in) as total_in")])
            ->get();

        $out = CashBookModel::where("cb_created_at",">=",$current_date)
            ->select([DB::raw("SUM(cb_out) as total_out")])
            ->get();

        $datas = DB::table('cash_account')
            ->leftJoin('users', 'users.id','=', 'cash_account.ca_user_id')
            ->get();

//        dd($profit->total_profit);

//        dd($profit, $jobs, $in, $out);



        $chart = $chart->build();
        $monthlyIncomeCharte = $monthlyIncomeCharte->build();
        $stockChart = $stockChart->build();
        $stockBarChart = $stockBarChart->build();



        return view('admin_home', compact('profit', 'jobs', 'in', 'out', 'datas', 'chart','monthlyIncomeCharte','stockChart','stockBarChart'));
    }
}
