<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $accessChart = $this->getAccessChart();
        $orderChart = $this->getOrderChart();
        $genderChart = $this->getGenderChart();
        return view('admin.dashboard.index', compact('accessChart','orderChart', 'genderChart'));
    }

    /**
     * LineChart.
     * @return mixed
     */
    protected function getAccessChart()
    {
        $lineChart = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['06:00', '10:00', '14:00', '16:00', '20:00', '24:00'])
            ->datasets([
                [
                    'label' => '今天访问',
                    'backgroundColor' => 'rgba(38, 180, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'data' => [1, 8907, 3000, 6780, 10000, 500],
                ],
                [
                    'label' => '昨天访问',
                    'backgroundColor' => 'rgba(252, 205, 86, .5)',
                    'borderColor' => 'rgba(236, 180, 37, .9)',
                    'data' => [12, 7896, 5450, 4560, 12345, 100],
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                            ],
                        ],
                    ],
                ],
            ]);

        return $lineChart;
    }

    /**
     * BarChart.
     * @return mixed
     */
    protected function getOrderChart()
    {
        $barChart = app()->chartjs
            ->name('barChart')
            ->type('bar')
            ->size(['width' => 1574, 'height' => 666])
            ->labels(['1', '2', '2', '3', '4', '5', '6','7','8','9','10','11','12'])
            ->datasets([
                [
                    'label' => '订单',
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)','rgba(32,152,218,0.2)','rgba(187,106,203,0.2)','rgba(203,106,178,0.5)','rgba(39,108,225,0.2)','rgba(225,216,39,0.2)','rgba(225,39,173,0.2)','rgba(238,88,109,0.2)'],
                    'borderColor' => ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', 'rgb(153, 102, 255)', 'rgb(201, 203, 207)','rgb(32,152,218)','rgb(187,106,203)','rgb(203,106,178)','rgb(39,108,225)','rgb(225,216,39)','rgb(225,39,173)','rgb(238,88,109)'],
                    'borderWidth' => 1,
                    'fill' => false,
                    'data' => [700, 600, 900, 1400, 1000, 700, 500,800,430,2009,2809,1245,1200],
                ],

            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                            ],
                        ],
                    ],
                ],
            ]);

        return $barChart;
    }

    /**
     * PieChart.
     * @return mixed
     */
    protected function getGenderChart()
    {
        $pieChart = app()->chartjs
            ->name('pieChart')
            ->type('pie')
            ->size(['width' => 400, 'height' => 286])
            ->labels(['男', '女', '未知'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#fCCD56'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB', '#fCCD56'],
                    'data' => [60, 30, 10],
                ],
            ])
            ->options([]);

        return $pieChart;
    }
}
