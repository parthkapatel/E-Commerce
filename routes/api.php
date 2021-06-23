<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class,'login']);

Route::post('/register', [RegisterController::class,'register']);

Route::get('/getCountryStateCity',[CountryController::class,'getCountryStateCity']);

Route::middleware("auth:sanctum")->group(function () {

    Route::prefix("/category")->group(function () {
        Route::post('/create-category', [CategoryController::class, 'store']);
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/checkSlugIsAvailable', [CategoryController::class, 'checkSlugIsAvailable']);
        Route::post('/updateCategoryStatus', [CategoryController::class, 'updateCategoryStatus']);
        Route::post('/updateCategoryData', [CategoryController::class, 'updateCategoryData']);
        Route::delete('/deleteCategoryData/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix("/product")->group(function () {
        Route::post('/create-product', [ProductController::class, 'store']);
        Route::get('/products', [ProductController::class, 'index']);
        Route::post('/checkSlugIsAvailable', [ProductController::class, 'checkSlugIsAvailable']);
        Route::post('/updateProductStatus', [ProductController::class, 'updateProductStatus']);
        Route::post('/updateProductData', [ProductController::class, 'updateProductData']);
        Route::delete('/deleteProductData/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix("/product-images")->group(function () {
        Route::post('/upload-product-images', [ProductImagesController::class, 'store']);
    });


});
