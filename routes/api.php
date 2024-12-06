<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;

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


Route::get('/get_roles',[RoleController::class,'getall']); //tested

Route::middleware('auth:sanctum')->group(function () {

   // Route::post("/addnewsubcategory",[SubCategoryController::class,'store']);
    // Protected routes for admin (role_id = 1)
    Route::middleware('checkRole:1')->group(function () {
        Route::get('/admin/users/{id}', [AdminController::class, 'show']);     //tested //
        Route::post('/storeadmin', action: [AdminController::class, 'store']);        //tested //
        Route::post('/update/{id}',[AdminController::class,'update']);       //tested //
        Route::delete('/destroy/{id}',[AdminController::class,'destroy']);  //tested //



        Route::post('/addcategory', [AdminController::class, 'Addcategory']);  //tested //
        Route::get('/show/category/{id}',[AdminController::class,'showcategory']); //tested //
        Route::post('/updatecategory/{id}', [AdminController::class, 'updatecategory']); //tested //
        Route::delete('/deletecategory/{id}', [AdminController::class, 'deletecategory']); //tested //
         //--------------------------------------------------------------------------------------
         Route::get('/getallcategories', [AdminController::class, 'getallcategory']); //tested //
         //---------------------------------------------------------------------------------------

         Route::post('/addsubcategory',[AdminController::class, 'Addsubcategory']); //tested //
         Route::get('/showsubcategory/{id}',[AdminController::class , 'showsubcategory']); //tested //
         Route::put('/updatesubcategory/{id}', [AdminController::class, 'updatesubcategory']); //tested //
         Route::delete('/deletesubcategory/{id}', [AdminController::class, 'deletesubcategory']); //tested //



        Route::post('/addproduct',[AdminController::class, 'Addproduct']); //tested //
        Route::put('/updateadmin/product/{id}', [AdminController::class, 'updateproduct']); //tested //
        Route::delete('/deleteadmin/product/{id}', [AdminController::class, 'deleteproduct']); //tested //
        Route::post('/admin/user/{id}/ban', [AdminController::class, 'banuser']); //tested //


        Route::post('/addoffer',[AdminController::class, 'Addoffer']); //tested //
        Route::get('/showoffer/{id}' ,[AdminController::class ,'showoffer']);   //tested //
        Route::post('/updateoffer/{id}', [AdminController::class, 'updateoffer']); //tested //
        Route::delete('/deleteoffer/{id}', [AdminController::class, 'deleteoffer']); //tested //

  Route::put('/admin/offer/{id}/change-state/{state}', [AdminController::class, 'ChangeOfferState']); //tested //


//-------------------------------------------------------------------------------------------------------------------
        // product controller
        Route::get('/get/products',[AdminController::class,'getallproduct']); //tested //


      //  Route::post('/updatequantity/{id}', [AdminController::class, 'Updateproductquantity']); //tested





    });

    // Protected routes for vendor (role_id = 2)
    Route::middleware('checkRole:2')->group(function () {
        //Route::get('/vendor/products', [App\Http\Controllers\ProductController::class, 'index']);
         //test
         Route::post('/storevendor',[VendorController::class,'store']); //tested
         Route::get('/show/vendor/{id}',[VendorController::class,'show']);  //tested
         Route::post('/updatevendor/{id}',[VendorController::class,'update']);  //tested
         Route::delete('/deletevendor/{id}',[VendorController::class,'destroy']);  //tested

         Route::post('/vendoraddproduct',[VendorController::class,'Addproduct']); //tested
         Route::post('/vendorupdateproduct/{id}', [VendorController::class, 'updateproduct']); //tested
         Route::delete('/vendordeleteproduct/{id}', [VendorController::class, 'deleteproduct']); //tested
         // write set quntity
    });

    // Protected routes for client (role_id = 3)
    Route::middleware('checkRole:3')->group(function () {
        // Route::get('/subcategories',[ProductController::class,'getbysubcategory']);

        //----------------------------------------------------------------
        //client controller
     //--------------------------------------------------------------------
     Route::post('/storeclient',[ClientController::class,'store']); //tested

     Route::get('/showclient/{id}',[ClientController::class,'show']);  //tested
     Route::post('/updateclient/{id}',[ClientController::class , 'update']); //tested
     Route::post('/deleteclient/{id}',[ClientController::class , 'destroy']); //tested

     Route::post('/make-order',[ClientController::class,'makeOrder']); //tested
     Route::delete('/deleteorder/{id}', [ClientController::class, 'deleteOrder']); //tested
     //-----------------------------------------------------------------------------------------
     //product controller
     //-------------------------------------------------------
//        Route::post('/storeproduct',[ProductController::class,'store']);
//        Route::get('/showproduct/{id}',[ProductController::class,'show']);
//        Route::post('/updateproduct/{id}', [ProductController::class, 'update']);
//        Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']);
//        Route::get('/products',[ClientController::class,'getall']);
//        Route::post('/updatequantity/{id}', [ProductController::class, 'updatequantity']);

//-----------------------------------------------------------------------------------------------
         //order controller

//      Route::post('/storeorder',[ClientController::class,'storeorder']);
//      Route::get('/showorder/{id}',[ClientController::class,'showorder']);
//      Route::post('/updateorder/{id}', [ClientController::class, 'updateorder']);
     //-------------------------------------------------------------------------------------
       //order details controller
     //-------------------------------------------------------------------------------------
    //  Route::post('/storeorderdetails',[ClientController::class,'storeorderdetail']);
    //  Route::get('/showorderdetails/{id}',[ClientController::class,'showorderdetail']);
    //  Route::post('/updateorderdetails/{id}',[ClientController::class, 'updateorderdetail']);
    });
});
