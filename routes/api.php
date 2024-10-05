<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\SpaceSectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('/spaces', SpaceController::class);
Route::apiResource('/items', ItemsController::class);
Route::apiResource('/sections', SectionController::class);
Route::apiResource('/spaces/{space}/sections', SpaceSectionController::class)->names([
    'index' => 'spaces.sections.index',
    'store' => 'spaces.sections.store',
    'show' => 'spaces.sections.show',
    'update' => 'spaces.sections.update',
    'destroy' => 'spaces.sections.destroy',
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
