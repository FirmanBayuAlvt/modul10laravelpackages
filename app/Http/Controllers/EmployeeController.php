<?php

// namespace App\Http\Controllers;
// // use Maatwebsite\Excel\Facades\Excel;
// // use App\Exports\EmployeesExport;
// use App\Models\Position;
// use PDF;
// use App\Models\Employee;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
// use RealRashid\SweetAlert\Facades\Alert;
// use App\Exports\EmployeesExport;
// use Maatwebsite\Excel\Facades\Excel;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// class EmployeeController extends Controller
// {
//     // public function index()
//     // {
//     //     $pageTitle = 'Employee List';
//     //     return view('employee.index', compact('pageTitle'));
//     // }

//     public function create()
//     {
//         $pageTitle = 'Create Employee';
//         $positions = Position::all();
//         return view('employee.create', compact('pageTitle', 'positions'));
//     }

//     public function store(Request $request)
//     {
//         $messages = [
//             'required' => ':Attribute harus diisi.',
//             'email' => 'Isi :attribute dengan format yang benar',
//             'numeric' => 'Isi :attribute dengan angka'
//         ];

//         $validator = Validator::make($request->all(), [
//             'firstName' => 'required',
//             'lastName' => 'required',
//             'email' => 'required|email',
//             'age' => 'required|numeric',
//         ], $messages);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         $file = $request->file('cv');
//         if ($file) {
//             $originalFilename = $file->getClientOriginalName();
//             $encryptedFilename = $file->hashName();
//             $file->store('public/files');
//         }

//         $employee = new Employee;
//         $employee->firstname = $request->firstName;
//         $employee->lastname = $request->lastName;
//         $employee->email = $request->email;
//         $employee->age = $request->age;
//         $employee->position_id = $request->position;

//         if ($file) {
//             $employee->original_filename = $originalFilename;
//             $employee->encrypted_filename = $encryptedFilename;
//         }

//         $employee->save();
//         Alert::success('Added Successfully', 'Employee Data Added Successfully.');

//         return redirect()->route('employees.index');
//     }


//     public function edit(string $id)
//     {
//         $pageTitle = 'Edit Employee';
//         $employee = Employee::find($id);

//         if (!$employee) {
//             return redirect()->route('employees.index')->with('error', 'Data employee tidak ditemukan.');
//         }

//         $positions = Position::all();
//         return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
//     }

//     public function update(Request $request, string $id)
//     {
//         $messages = [
//             'required' => ':Attribute harus diisi.',
//             'email' => 'Isi :attribute dengan format yang benar',
//             'numeric' => 'Isi :attribute dengan angka'
//         ];

//         $validator = Validator::make($request->all(), [
//             'firstName' => 'required',
//             'lastName' => 'required',
//             'email' => 'required|email',
//             'age' => 'required|numeric',
//         ], $messages);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         $employee = Employee::find($id);
//         if (!$employee) {
//             return redirect()->route('employees.index')->with('error', 'Data employee tidak ditemukan.');
//         }

//         $file = $request->file('cv');
//         if ($file) {
//             if ($employee->encrypted_filename && Storage::exists('public/files/' . $employee->encrypted_filename)) {
//                 Storage::delete('public/files/' . $employee->encrypted_filename);
//             }

//             $originalFilename = $file->getClientOriginalName();
//             $encryptedFilename = $file->hashName();
//             $file->store('public/files');

//             $employee->original_filename = $originalFilename;
//             $employee->encrypted_filename = $encryptedFilename;
//         }

//         $employee->firstname = $request->firstName;
//         $employee->lastname = $request->lastName;
//         $employee->email = $request->email;
//         $employee->age = $request->age;
//         $employee->position_id = $request->position;
//         $employee->save();

//         Alert::success('Changed Successfully', 'Employee Data Changed Successfully.');
//         return redirect()->route('employees.index');
//     }

//     public function destroy(string $id)
//     {
//         $employee = Employee::find($id);
//         if (!$employee) {
//             return redirect()->route('employees.index')->with('error', 'Employee not found.');
//         }

//         if ($employee->encrypted_filename && Storage::exists('public/files/' . $employee->encrypted_filename)) {
//             Storage::delete('public/files/' . $employee->encrypted_filename);
//         }

//         $employee->delete();

//         Alert::success('Deleted Successfully', 'Employee Data Deleted Successfully.');
//         return redirect()->route('employees.index');
//     }

//     public function downloadCV($id)
//     {
//         $employee = Employee::find($id);
//         $encryptedFilename = 'public/files/' . $employee->encrypted_filename;
//         $downloadFilename = Str::lower($employee->firstname . '_' . $employee->lastname . '_cv.pdf');

//         if (Storage::exists($encryptedFilename)) {
//             return Storage::download($encryptedFilename, $downloadFilename);
//         }

//         return redirect()->route('employees.index')->with('error', 'File not found.');
//     }

//     public function getData(Request $request)
//     {
//         $employees = Employee::with('position');

//         if ($request->ajax()) {
//             return datatables()->of($employees)
//                 ->addIndexColumn()
//                 ->addColumn('actions', function ($employee) {
//                     return view('employee.actions', compact('employee'));
//                 })
//                 ->toJson();
//         }
//     }

//     // public function exportExcel()
//     // {
//     //     return Excel::download(new EmployeesExport, 'employees.xlsx');
//     // }

//     public function show(string $id)
//     {
//         $pageTitle = 'Employee Detail';
//         $employee = Employee::find($id);

//         if (!$employee) {
//             return redirect()->route('employees.index')->with('error', 'Employee not found.');
//         }

//         return view('employee.show', compact('pageTitle', 'employee'));
//     }



//     // public function exportToExcel()
//     // {
//     //     // Ambil data dari tabel Employee
//     //     $employees = Employee::all();

//     //     // Buat objek Spreadsheet baru
//     //     $spreadsheet = new Spreadsheet();

//     //     // Set nama-nama kolom
//     //     $spreadsheet->getActiveSheet()->setCellValue('A1', 'ID');
//     //     $spreadsheet->getActiveSheet()->setCellValue('B1', 'First Name');
//     //     $spreadsheet->getActiveSheet()->setCellValue('C1', 'Last Name');
//     //     $spreadsheet->getActiveSheet()->setCellValue('D1', 'Email');
//     //     $spreadsheet->getActiveSheet()->setCellValue('E1', 'Age');
//     //     $spreadsheet->getActiveSheet()->setCellValue('F1', 'Position');

//     //     // Set data dari tabel ke file Excel
//     //     $row = 2;
//     //     foreach ($employees as $employee) {
//     //         $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $employee->id);
//     //         $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $employee->firstname);
//     //         $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $employee->lastname);
//     //         $spreadsheet->getActiveSheet()->setCellValue('D'.$row, $employee->email);
//     //         $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $employee->age);
//     //         $spreadsheet->getActiveSheet()->setCellValue('F'.$row, $employee->position->name);

//     //         $row++;
//     //     }

//     //     // Buat file Excel
//     //     $filename = 'employees.xlsx';
//     //     $writer = new Xlsx($spreadsheet);
//     //     $writer->save($filename);

//     //     // Kembali ke halaman sebelumnya
//     //     return redirect()->back();
//     // }

//     public function exportExcel()
//     {
//         return Excel::download(new EmployeesExport, 'employees.xlsx');
//     }
//     public function exportPdf()
//     {
//         $employees = Employee::all();

//         $pdf = PDF::loadView('employee.export_pdf', compact('employees'));

//         return $pdf->download('employees.pdf');
//     }
// public function index()
// {
//     $pageTitle = 'Employee List';
//     confirmDelete();
//     $positions = Position::all();
//     return view('employee.index', [
//         'pageTitle' => $pageTitle,
//         'positions' => $positions
//     ]);
// }


// }


namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;

class EmployeeController extends Controller
{
    public function create()
    {
        $pageTitle = 'Create Employee';
        $positions = Position::all();
        return view('employee.create', compact('pageTitle', 'positions'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('cv');
        if ($file) {
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            $file->store('public/files');
        }

        $employee = new Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;

        if ($file) {
            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }

        $employee->save();
        Alert::success('Added Successfully', 'Employee Data Added Successfully.');

        return redirect()->route('employees.index');
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Data employee tidak ditemukan.');
        }

        $positions = Position::all();
        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Data employee tidak ditemukan.');
        }

        $file = $request->file('cv');
        if ($file) {
            if ($employee->encrypted_filename && Storage::exists('public/files/' . $employee->encrypted_filename)) {
                Storage::delete('public/files/' . $employee->encrypted_filename);
            }

            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            $file->store('public/files');

            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }

        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        Alert::success('Changed Successfully', 'Employee Data Changed Successfully.');
        return redirect()->route('employees.index');
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Employee not found.');
        }

        if ($employee->encrypted_filename && Storage::exists('public/files/' . $employee->encrypted_filename)) {
            Storage::delete('public/files/' . $employee->encrypted_filename);
        }

        $employee->delete();

        Alert::success('Deleted Successfully', 'Employee Data Deleted Successfully.');
        return redirect()->route('employees.index');
    }

    public function downloadCV($id)
    {
        $employee = Employee::find($id);
        $encryptedFilename = 'public/files/' . $employee->encrypted_filename;
        $downloadFilename = Str::lower($employee->firstname . '_' . $employee->lastname . '_cv.pdf');

        if (Storage::exists($encryptedFilename)) {
            return Storage::download($encryptedFilename, $downloadFilename);
        }

        return redirect()->route('employees.index')->with('error', 'File not found.');
    }

    public function getData(Request $request)
    {
        $employees = Employee::with('position');

        if ($request->ajax()) {
            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('actions', function ($employee) {
                    return view('employee.actions', compact('employee'));
                })
                ->toJson();
        }
    }

    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Employee not found.');
        }

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    public function exportExcel()
    {
        // Retrieve all employees
        $employees = Employee::with('position')->get();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Your Name')
            ->setLastModifiedBy('Your Name')
            ->setTitle('Employees Data')
            ->setSubject('Employees Data')
            ->setDescription('Exported employees data')
            ->setKeywords('employees')
            ->setCategory('Data');

        // Add some data
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'First Name')
            ->setCellValue('C1', 'Last Name')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Age')
            ->setCellValue('F1', 'Position');

        $row = 2;
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee->id)
                ->setCellValue('B' . $row, $employee->firstname)
                ->setCellValue('C' . $row, $employee->lastname)
                ->setCellValue('D' . $row, $employee->email)
                ->setCellValue('E' . $row, $employee->age)
                ->setCellValue('F' . $row, $employee->position->name);
            $row++;
        }

        // Write file to disk
        $writer = new Xlsx($spreadsheet);
        $filename = 'employees.xlsx';
        $writer->save($filename);

        // Return file as a response for download
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function exportPdf()
    {
        $employees = Employee::all();

        $pdf = PDF::loadView('employee.export_pdf', compact('employees'));

        return $pdf->download('employees.pdf');
    }

    public function index()
    {
        $pageTitle = 'Employee List';
        $positions = Position::all();
        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'positions' => $positions
        ]);
    }
}
