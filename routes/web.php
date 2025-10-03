<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Superadmin\AdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;



//ALO


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{id}/reserve', [ReservationController::class, 'store'])->name('products.reserve');

Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth' , 'role:admin|super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Produits
    Route::resource('products', AdminProductController::class);
    Route::patch('/products/{product}/toggle-visibility', [AdminProductController::class, 'toggleVisibility'])->name('products.toggleVisibility');

    // Catégories
     Route::resource('categories', CategoryController::class)->except(['show']);

    // Images
    //Route::post('products/{product}/images', [ProductImageController::class, 'store'])->name('products.images.store');
    //Route::delete('images/{image}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    //Route::post('images/{image}/move-up', [ProductImageController::class, 'moveUp'])->name('products.images.move_up');
    //Route::post('images/{image}/move-down', [ProductImageController::class, 'moveDown'])->name('products.images.move_down');

    Route::prefix('admin/products/{product}')->name('products.')->middleware('role:admin|super_admin')->group(function () {
        Route::post('/images', [ProductImageController::class, 'store'])->name('images.store');
        Route::patch('/images/{image}/main', [ProductImageController::class, 'setMain'])->name('images.setMain');
        Route::patch('/images/{image}/order', [ProductImageController::class, 'updateOrder'])->name('images.updateOrder');
        Route::delete('/images/{image}', [ProductImageController::class, 'destroy'])->name('images.destroy');
    });

    /*Réservations
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::patch('reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.updateStatus'); */
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware(['auth', 'role:super_admin'])
    ->group(function () {
        // Resource route for managing admin users
        Route::resource('admin', AdminUserController::class)
            ->names('admin'); // route names: superadmin.admin.index, etc.
    });

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});



Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/sidebar', [CartController::class, 'sidebar'])->name('cart.sidebar');



Route::middleware('auth')->group(function () {
    // multiple products order (from cart)
    Route::post('/orders/store-from-cart', [OrderController::class, 'storeFromCart'])
        ->name('orders.storeFromCart');

    //single product order (from product page)
     Route::post('/orders/{product}', [OrderController::class, 'storeSingle'])
        ->name('orders.storeSingle');

    Route::get('/orders/{order}/confirmation', [OrderController::class, 'confirmation'])
        ->name('orders.confirmation');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
});


require __DIR__.'/auth.php';
