<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


/*仮）商品一覧ページを取得*/ 
Route::get('/products', [ProductController::class, 'index']);

/*登録画面を取得*/
Route::get('/products/register', [ProductController::class, 'register']);

/*登録を保存*/
Route::post('/products', [ProductController::class, 'store']);

/*検索*/
Route::get('/products/search', [ProductController::class, 'search']);

/*詳細ページを取得*/
Route::get('/products/{product_id}', [ProductController::class, 'show']);

/*削除*/
Route::post('/products/{product_id}/delete', [ProductController::class, 'destroy']);

/*更新*/
Route::patch('/products/{product_id}/update', [ProductController::class, 'update']);


