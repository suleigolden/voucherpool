<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//view all the voucher pool
Route::get('/','voucherController@generateAllVoucherPool');

//Generate New Voucher Code
Route::post('/post_Generaate_Code','voucherController@generateVoucherCode');

//Verify Voucher Code
Route::post('/post_Verify_voucher_Code','voucherController@verifyVoucherCode');