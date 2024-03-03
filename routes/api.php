<?php

use Illuminate\Support\Facades\Route;
use Noorfarooqy\SchoolModule\Controllers\SchoolController;



Route::middleware(['auth:sanctum', 'scm'])->group(function () {

    Route::group(['prefix' => '/api/v1/scm/', 'as' => 'v1.schm.'], function () {
        Route::post('/new', [SchoolController::class, 'newSchool'])->name('scm-new')->can('scm_write');
        Route::get('/school', [SchoolController::class, 'getSchoolDetails'])->name('scm-details')->can('scm_read');
    });
});
