<?php
namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('login','App\Http\Controllers\Auth\LoginController@login');
Route::any('logout','App\Http\Controllers\Auth\LoginController@logout');







// Route::group(['middleware' => 'auth'], function() {

// Route::any('getUser','App\Http\Controllers\HomeController@getUser');

// Route::any('editUser/{id}','App\Http\Controllers\HomeController@editUser');

// Route::any('updateUser','App\Http\Controllers\HomeController@updateUser');

// Route::any('deleteUser/{id}','App\Http\Controllers\HomeController@deleteUser');

// Route::any('changePassword','App\Http\Controllers\ChangePassword@changePassword');

// Route::any('getName','App\Http\Controllers\HomeController@getUserName');
// Route::any('getUserId','App\Http\Controllers\HomeController@getUserId');

//  });

 Route::middleware(['api'])->group(function () {
    Route::any('getUser','App\Http\Controllers\HomeController@getUser');

    Route::any('editUser/{id}','App\Http\Controllers\HomeController@editUser');
    
    Route::any('updateUser','App\Http\Controllers\HomeController@updateUser');
    
    Route::any('deleteUser/{id}','App\Http\Controllers\HomeController@deleteUser');
    
    Route::any('changePassword','App\Http\Controllers\ChangePassword@changePassword');
    
    Route::any('getName','App\Http\Controllers\HomeController@getUserName');
    Route::any('searchUser','App\Http\Controllers\HomeController@searchUser');

    Route::any('getUserId','App\Http\Controllers\HomeController@getUserId');
    Route::any('productUpload','App\Http\Controllers\ProductController@productUpload');
    Route::any('multiUpload','App\Http\Controllers\ProductController@multiUpload');


});







