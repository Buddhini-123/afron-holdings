<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\MobilizationController;
use App\Http\Controllers\MasterListController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BriefController;
use App\Http\Controllers\MetricController;


Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/project', [HomeController::class, 'overview'])->name('project.overview');
Route::get('/summary-navigation', [HomeController::class, 'navigation'])->name('summary.navigation');

Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
Route::get('/docs/show', [DocsController::class, 'showExcelData'])->name('docs.show');

Route::get('/masterlist', [MasterListController::class, 'index'])->name('masterlist.index');
Route::get('/masterlist/show', [MasterListController::class, 'showExcelData'])->name('masterlist.show');

Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::get('/status/show', [StatusController::class, 'showExcelData'])->name('status.show');

Route::get('/brief/{filter?}', [BriefController::class, 'index'])->name('brief.index');
Route::get('/project-brief/show/{filter?}', [BriefController::class, 'showExcelData'])->name('brief.show');

Route::get('/mobilization/{filter?}', [MobilizationController::class, 'index'])->name('mobilization.index');
Route::post('/mobilization', [MobilizationController::class, 'store'])->name('mobilization.store');
Route::post('/import-mobilization', [MobilizationController::class, 'importExcel'])->name('import.mobilization');
Route::post('/save-excel', [MobilizationController::class, 'saveExcel'])->name('save.excel');
Route::post('/save-excel-re', [DocsController::class, 'saveExcelRE'])->name('save.re');
Route::post('/save-excel-mastelist', [MasterListController::class, 'saveExcelM'])->name('save.master');
Route::post('/save-excel-status', [StatusController::class, 'saveExcelStatus'])->name('save.status');
Route::post('/save-excel-brief', [BriefController::class, 'saveExcelStatus'])->name('save.brief');

// Increment counts
Route::post('/metrics/increment-calls', [MetricController::class, 'incrementCalls'])->name('metrics.incrementCalls');
Route::post('/metrics/increment-customer-visited', [MetricController::class, 'incrementCustomerVisited'])->name('metrics.incrementCustomerVisited');
Route::post('/metrics/increment-approved', [MetricController::class, 'incrementApproved'])->name('metrics.incrementApproved');
Route::post('/metrics/increment-selected', [MetricController::class, 'incrementSelected'])->name('metrics.incrementSelecetd');





