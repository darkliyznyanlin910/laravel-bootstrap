<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PayPalController;

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

Route::get('/', [ItemController::class, 'index']);
Route::post('/search', [ItemController::class, 'search']);

Auth::routes();

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::group(['middleware' => ['auth']], function() {
    
    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
        
        Route::get('summary', [AdminController::class, 'summary'])->name('summary');

        Route::get('pending_orders', [AdminController::class, 'pending_orders'])->name('pending_orders');

        Route::get('order_history', [AdminController::class, 'order_history'])->name('order_history');

        Route::get('manage_items', [AdminController::class, 'manage_items'])->name('manage_items');

        Route::post('edit_items', [AdminController::class, 'edit_items']);

        Route::post('edit_items_process', [AdminController::class, 'edit_items_process']);

        Route::get('delete_items/{id}', [AdminController::class, 'delete_items'])->name('delete_items');

        Route::get('activate_items/{id}', [AdminController::class, 'activate_items'])->name('activate_items');

        Route::get('deactivate_items/{id}', [AdminController::class, 'deactivate_items'])->name('deactivate_items');

        Route::get('add_new_item', [AdminController::class, 'add_new_item'])->name('add_new_item');

        Route::post('add_new_item_process', [AdminController::class, 'add_new_item_process'])->name('add_new_item_process');
        
        Route::get('manage_category', [AdminController::class, 'manage_category'])->name('manage_category');

        Route::get('update_discount_process', [AdminController::class, 'update_discount_process']);

        Route::post('add_new_category_process', [AdminController::class, 'add_new_category_process']);

        Route::post('remove_category_process', [AdminController::class, 'remove_category_process']);

        Route::post('stock_update_process', [AdminController::class, 'stock_update_process'])->name('stock_update_process');

        Route::post('stock_remove_process', [AdminController::class, 'stock_update_process'])->name('stock_remove_process');

        Route::get('admin_order_update/{order_id}/{status}', [AdminController::class, 'admin_order_update']);

        Route::post('admin_order_update', function(){

            $order_id = Input::get('order_id');
            $status = Input::get('status');   
         
            return Redirect::action([AdminController::class, 'admin_order_update'], array('order_id'=>$order_id, 'status'=>$status));
        
        });

        Route::get('/profile', [OrderHistoryController::class, 'index'])->name('profile');

        Route::get('/cart', [SessionController::class, 'cart'])->name('cart');

        Route::post('/add', [SessionController::class, 'add'])->name('add');

        Route::post('/remove', [SessionController::class, 'remove'])->name('remove');

        Route::get('/checkout', [SessionController::class, 'checkout'])->name('checkout');

        Route::post('/confirm', [SessionController::class, 'confirm'])->name('createTransaction');

        Route::get('/confirm', [SessionController::class, 'confirm'])->name('createTransaction');

        Route::post('/invoice', [PDFController::class, 'invoice'])->name('invoice');

        Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
    });

    Route::group(['middleware' => 'App\Http\Middleware\CustomerMiddleware'], function(){

        Route::get('/profile', [OrderHistoryController::class, 'index'])->name('profile');

        Route::get('/cart', [SessionController::class, 'cart'])->name('cart');

        Route::post('/add', [SessionController::class, 'add'])->name('add');

        Route::post('/remove', [SessionController::class, 'remove'])->name('remove');

        Route::get('/checkout', [SessionController::class, 'checkout'])->name('checkout');

        Route::post('/confirm', [SessionController::class, 'confirm'])->name('createTransaction');

        Route::get('/confirm', [SessionController::class, 'confirm'])->name('createTransaction');

        Route::post('/invoice', [PDFController::class, 'invoice'])->name('invoice');

        Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
    });

});