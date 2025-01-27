<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::post('/generate-report', [ReportController::class, 'generateReport']);
Route::get('/list-reports', [ReportController::class, 'listReports']);
Route::get('/get-report/{id}', [ReportController::class, 'getReport']);
