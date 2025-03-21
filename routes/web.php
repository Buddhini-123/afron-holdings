<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\MobilizationController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/project', [HomeController::class, 'overview'])->name('project.overview');

Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');

Route::get('/mobilization', [MobilizationController::class, 'index'])->name('mobilization.index');
Route::post('/import-mobilization', [MobilizationController::class, 'importExcel'])->name('import.mobilization');
Route::post('/save-excel', [MobilizationController::class, 'saveExcel'])->name('save.excel');
Route::post('/save-excel-re', [DocsController::class, 'saveExcelRE'])->name('save.re');

