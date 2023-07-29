<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\DocFieldController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// List All Docs
Route::get('docs', [DocController::class, 'getDocs']);

// Create New Doc
Route::post('new-doc', [DocController::class, 'newDoc']);

// Delete a Doc
Route::delete('delete-doc', [DocController::class, 'deleteDoc']);

// List All Doc Fields
Route::get('fields', [DocFieldController::class, 'getDocFields']);

// Create New Doc Field
Route::post('new-field', [DocFieldController::class, 'newDocField']);

// Delete a Doc Field
Route::delete('delete-field', [DocFieldController::class, 'deleteDocField']);

// Download a Doc
Route::get('download-doc', [DocController::class, 'downLoadDoc']);
