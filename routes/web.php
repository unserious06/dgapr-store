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
use App\Http\Controllers\Superadmin\AdminUserController;



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

    // Réservations
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::patch('reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Route::middleware(['role:admin'])->get('/test1', function () {
    return 'Admin here!';
});
Route::middleware(['role:super_admin'])->get('/test2', function () {
    return 'Super Admin here!';
});*/

// Superadmin routes

Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware(['auth', 'role:super_admin'])
    ->group(function () {
        // Resource route for managing admin users
        Route::resource('admin', AdminUserController::class)
            ->names('admin'); // route names: superadmin.admin.index, etc.
    });



require __DIR__.'/auth.php';
