<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\EmployeeController;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::post('/login', [LoginController::class, 'authenticate'])->name('login'); // Tambahkan definisi rute untuk login

// Route::get('profile', [ProfileController::class, 'index'])->name('profile');

// Route::resource('employees', EmployeeController::class);

// Route::post('/create', [EmployeeController::class, 'create']);

// Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Route::get('/local-disk', function () {
//     Storage::disk('local')->put('local-example.txt', 'This is local example content');
//     return asset('storage/local-example.txt');

//     Route::get('/public-disk', function () {
//         Storage::disk('public')->put('public-example.txt', 'This is public example content');
//         return asset('storage/public-example.txt');

//         Route::get('/retrieve-local-file', function () {
//             if (Storage::disk('local')->exists('local-example.txt')) {
//                 $contents = Storage::disk('local')->get('local-example.txt');
//             } else {
//                 $contents = 'File does not exist';
//             }
//             return $contents;
//             Route::get('/retrieve-public-file', function () {
//                 if (Storage::disk('public')->exists('public-example.txt')) {
//                     $contents = Storage::disk('public')->get('public-example.txt');
//                 } else {
//                     $contents = 'File does not exist';
//                 }
//                 return $contents;

//                 Route::get('/download-local-file', function () {
//                     return Storage::download('local-example.txt', 'local file');
//                     Route::get('/download-public-file', function () {
//                         return Storage::download('public/public-example.txt', 'public file');
//                         Route::get('/file-url', function () {
//                             // Just prepend "/storage" to the given path and return a relative URL
//                             $url = Storage::url('local-example.txt');
//                             return $url;
//                         });
//                         Route::get('/file-size', function () {
//                             $size = Storage::size('local-example.txt');
//                             return $size;
//                         });
//                         Route::get('/file-path', function () {
//                             $path = Storage::path('local-example.txt');
//                             return $path;
//                             Route::get('/upload-example', function () {
//                                 return view('upload_example');
//                             });
//                             Route::post('/upload-example', function (Request $request) {
//                                 $path = $request->file('avatar')->store('public');
//                                 return $path;
//                             })->name('upload-example');
//                             Route::get('/delete-local-file', function (Request $request) {
//                                 Storage::disk('local')->delete('local-example.txt');
//                                 return 'Deleted';
//                             });
//                             Route::get('/delete-public-file', function (Request $request) {
//                                 Storage::disk('public')->delete('public-example.txt');
//                                 return 'Deleted';
//                             });
//                             // Route::get('download-file/{employeeId}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');
//                             // Route::get('/employees/downloadFile/{id}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');
//                             Route::get('download-file/{employeeId}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');
//                         });
//                     });
//                 });
//             });
//         });
//     });
// });


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');

Route::resource('employees', EmployeeController::class);

Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('/local-disk', function () {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
    return asset('storage/local-example.txt');
});

Route::get('/public-disk', function () {
    Storage::disk('public')->put('public-example.txt', 'This is public example content');
    return asset('storage/public-example.txt');
});

Route::get('/retrieve-local-file', function () {
    if (Storage::disk('local')->exists('local-example.txt')) {
        $contents = Storage::disk('local')->get('local-example.txt');
    } else {
        $contents = 'File does not exist';
    }
    return $contents;
});

Route::get('/retrieve-public-file', function () {
    if (Storage::disk('public')->exists('public-example.txt')) {
        $contents = Storage::disk('public')->get('public-example.txt');
    } else {
        $contents = 'File does not exist';
    }
    return $contents;
});

Route::get('/download-local-file', function () {
    return Storage::download('local-example.txt', 'local file');
});

Route::get('/download-public-file', function () {
    return Storage::download('public/public-example.txt', 'public file');
});

Route::get('/file-url', function () {
    $url = Storage::url('local-example.txt');
    return $url;
});

Route::get('/file-size', function () {
    $size = Storage::size('local-example.txt');
    return $size;
});

Route::get('/file-path', function () {
    $path = Storage::path('local-example.txt');
    return $path;
});

Route::get('/upload-example', function () {
    return view('upload_example');
});

Route::post('/upload-example', function (Request $request) {
    $path = $request->file('avatar')->store('public');
    return $path;
})->name('upload-example');

Route::get('/delete-local-file', function () {
    Storage::disk('local')->delete('local-example.txt');
    return 'Deleted';
});

Route::get('/delete-public-file', function () {
    Storage::disk('public')->delete('public-example.txt');
    return 'Deleted';
});

// Definisikan rute downloadFile
Route::get('/employees/downloadFile/{id}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
// Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::get('/employees/{employee}/download', [EmployeeController::class, 'downloadCV'])->name('employees.download');

Route::get('getEmployees', [EmployeeController::class, 'getData'])->name('employees.getData');

// Route::get('exportExcel', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');


// Route::get('employees/export', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');

// Route::get('/employees/exportExcel', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');

// Route::get('/employees/exportExcel', [EmployeeController::class, 'exportToExcel'])->name('employees.exportExcel');

Route::get('exportExcel', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');

Route::get('exportPdf', [EmployeeController::class, 'exportPdf'])->name('employees.exportPdf');
