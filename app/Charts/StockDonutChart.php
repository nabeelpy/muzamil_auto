<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StockDonutChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {

        $datas = DB::table('parts')->get();


        $qty = [];
        $part_name = [];
        foreach ($datas as $work) {
            $qty[] = $work->par_total_qty;
            $part_name[] = $work->par_name;
        }


        return $this->chart->donutChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData($qty)
            ->setLabels($part_name);
    }
}
