<?php

use App\Http\Controllers\ReportSpgdtController;
use Illuminate\Support\Facades\Route;

Route::get('/report-spgdt', [ReportSpgdtController::class, 'getData'])->name('report-spgdt');
