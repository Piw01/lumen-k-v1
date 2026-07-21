<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipmentApiController;

/*
|--------------------------------------------------------------------------
| REST API Routes - Lumen-K
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    Route::get('/equipment', [EquipmentApiController::class, 'index']);
    Route::get('/equipment/{id}', [EquipmentApiController::class, 'show']);
});