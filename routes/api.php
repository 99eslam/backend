<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
//use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdminController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['web'])->group(function () {
    Auth::routes();
});

Route::middleware('auth:sanctum')->group(function () { //check token
    Route::post('/logout', [LoginController::class, 'logout']);

    // Protected routes for admin (role_id = 1)
    Route::middleware('checkRole:1')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index']);//test

        Route::post('store',[AdminController::class,'store']);
        Route::get('show',[AdminController::class,'show']);
        Route::put('update',[AdminController::class,'update']);
        Route::delete('destroy',[AdminController::class,'destroy']);

        Route::get('/addproduct',[AdminController::class, 'Addproduct']);
        Route::put('/updateadmin/product/{id}', [AdminController::class, 'updateproduct']);
        Route::delete('/deleteadmin/product/{id}', [AdminController::class, 'deleteproduct']);
        Route::post('/admin/user/{id}/ban', [AdminController::class, 'banuser']);

        Route::get('/addoffer',[AdminController::class, 'Addoffer']);
        Route::put('/updateoffer', [AdminController::class, 'updateoffer']);
        Route::delete('/deleteoffer', [AdminController::class, 'deleteoffer']);

        Route::put('/offers/{id}/state', [AdminController::class, 'ChangeOfferState']);

        Route::get('/addcategory', [AdminController::class, 'Addcategory']);
        Route::post('/updatecategory/{id}', [AdminController::class, 'updatecategory']);
        Route::delete('/deletecategory/{id}', [AdminController::class, 'deletecategory']);
        //--------------------------------------------
        Route::get('/get/category', [AdminController::class, 'getallcategory']);
        //---------------------------------------------
        Route::get('/addsubcategory',[AdminController::class, 'Addsubcategory']);
        Route::post('/updatesubcategory/{id}', [AdminController::class, 'updatesubcategory']);
        Route::delete('/deletesubcategory/{id}', [AdminController::class, 'deletesubcategory']);
        //----------------------------------------------------------------
            // product controller
        Route::get('/get/products',[AdminController::class,'getallproduct']);
        Route::post('/updatequantity/{id}/quantity', [AdminController::class, 'Updateproductquantity']);



    });

    // Protected routes for vendor (role_id = 2)
    Route::middleware('checkRole:2')->group(function () {
//        Route::get('/vendor/products', [ProductController::class, ?'index']); //test
       // --------------------------------------------------------
          // vendor controller
      //----------------------------------------------------------
        Route::post('/storevendor',[VendorController::class,'store']);
        Route::get('/vendoraddproduct',[VendorController::class,'Addproduct']);
        Route::post('/vendorupdateproduct/{id}', [VendorController::class, 'updateproduct']);
        Route::delete('/vendordeleteproduct/{id}', [VendorController::class, 'deleteproduct']);

    });

    // Protected routes for client (role_id = 3)
    Route::middleware('checkRole:3')->group(function () {
//        Route::get('/client/orders', [OrderController::class, 'index']); //test
     //----------------------------------------------------------------
        //client controller
     //--------------------------------------------------------------------
        Route::post('/storeclient',[ClientController::class,'store']);
        Route::get('/showclient/{id}',[ClientController::class,'show']);
        Route::post('/make-order',[ClientController::class,'makeOrder']);
        Route::delete('/deleteorder/{id}', [ClientController::class, 'deleteOrder']);
        //-----------------------------------------------------------------------------------------
        //product controller
        //-------------------------------------------------------
//        Route::post('/storeproduct',[ProductController::class,'store']);
//        Route::get('/showproduct/{id}',[ProductController::class,'show']);
//        Route::post('/updateproduct/{id}', [ProductController::class, 'update']);
//        Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']);
//        Route::get('/products',[ClientController::class,'getall']);
//        Route::post('/updatequantity/{id}', [ProductController::class, 'updatequantity']);
//        Route::get('/subcategories',[ProductController::class,'getbysubcategory']);
//-----------------------------------------------------------------------------------------------
            //order controller

        Route::post('/storeorder',[ClientController::class,'storeorder']);
        Route::get('/showorder/{id}',[ClientController::class,'showorder']);
        Route::post('/updateorder/{id}', [ClientController::class, 'updateorder']);
//        Route::delete('/deleteorder/{id}', [OrderController::class, 'destroy']);
        //-------------------------------------------------------------------------------------
          //order details controller
        //-------------------------------------------------------------------------------------
        Route::post('/storeorderdetails',[ClientController::class,'storeorderdetail']);
        Route::get('/showorderdetails/{id}',[ClientController::class,'showorderdetail']);
        Route::post('/updateorderdetails/{id}',[ClientController::class, 'updateorderdetail']);
        Route::delete('/deleteorderdetails/{id}',[ClientController::class, 'deleteorderdetail']);


    });


});
