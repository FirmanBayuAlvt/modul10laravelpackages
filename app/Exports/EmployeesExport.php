<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\View as ViewFacade;

// class EmployeesExport implements FromView, WithStyles, ShouldAutoSize
// {
//     public function styles(Worksheet $sheet)
//     {
//         return [
//             1 => ['font' => ['bold' => true]],
//         ];
//     }

//     public function view(): View
//     {
//         return view('employee.export_excel', [
//             'employees' => Employee::all()
//         ]);
//     }
// }
class EmployeesExport
{
    public function export()
    {
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply styles
        $this->applyStyles($sheet);

        // Load the view and get employees data
        $view = ViewFacade::make('employee.export_excel', [
            'employees' => Employee::all()
        ]);

        // Convert the view to HTML and load into spreadsheet
        $html = $view->render();
        \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Html')->load($html);

        // Create a writer and save the file to the desired path
        $writer = new Xlsx($spreadsheet);
        $writer->save('path/to/your/file.xlsx');

        return response()->download('path/to/your/file.xlsx');
    }

    public function applyStyles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true);
    }
}
