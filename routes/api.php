<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\SubmenuItemController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\PageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contacts', [ContactController::class, 'store']);

Route::post('/inscriptions', [InscriptionController::class, 'store']);

Route::get('/cours', [CoursController::class, 'index']);
Route::get('/cours/{cours}', [CoursController::class, 'show']);

Route::get('/submenu-items', [SubmenuItemController::class, 'index']);

Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{page}', [PageController::class, 'show']);
Route::get('/pages/submenu/{submenuId}', [PageController::class, 'getBySubmenu']); // Get single page by submenu
Route::get('/solutions/submenu/{submenuId}', [SolutionController::class, 'getBySubmenu']); // Get single page by submenu
Route::get('/solutions/{solutionId}/details', [SolutionController::class, 'getSolutionWithDetails']); // Get solution with details and sections