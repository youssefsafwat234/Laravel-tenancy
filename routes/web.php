<?php

use App\Http\Controllers\TestController;
use App\Models\Store;
use App\Models\User;
use Checkout\CheckoutSdk;
use Checkout\Environment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('tenant')->group(function () {

    Route::get('/', function () {
//    return view('welcome');
        return response()->json(\App\Models\Product::all());
    });

});





