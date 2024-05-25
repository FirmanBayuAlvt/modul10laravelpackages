<?php

// namespace App\Charts;

// use App\Models\Position;
// use ArielMejiaDev\LarapexCharts\LarapexChart;
// use ConsoleTVs\Charts\Classes\Chartjs\Chart;

// class EmployeesChart extends Chart
// {
//     /**
//      * Initializes the chart.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         parent::__construct();
//     }
//     public function build(): \ArielMejiaDev\LarapexCharts\BarChart
//     {
//         $positions = Position::withCount('employees')->get();
//         $positionsLabels = $positions->pluck('name')->toArray();
//         $employeesCount = $positions->pluck('employees_count')->toArray();
//         return $this->chart->barChart()
//             ->setTitle('Posisi')
//             ->setSubtitle('Posisi dengan Jumlah Karyawan Terbanyak')
//             ->addData('Jumlah Karyawan', $employeesCount)
//             ->setXAxis($positionsLabels);
//     }
// }

namespace App\Charts;

use App\Models\Position;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class EmployeesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $positions = Position::withCount('employees')->get();
        $positionsLabels = $positions->pluck('name')->toArray();
        $employeesCount = $positions->pluck('employees_count')->toArray();

        return $this->chart->barChart()
            ->setTitle('Posisi')
            ->setSubtitle('Posisi dengan Jumlah Karyawan Terbanyak')
            ->addData('Jumlah Karyawan', $employeesCount)
            ->setXAxis($positionsLabels);
    }
}
