<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function(){
    Route::post('/register', [authController::class, 'register']);
    Route::post('/login', [authController::class, 'login']);
});

Route::prefix('products')->group(function(){
    Route::get('/', [productController::class, 'index'])->middleware(Authenticate::class);
    Route::get('/{id}', [productController::class, 'showProduct'])->middleware(Authenticate::class);
    Route::post('/', [productController::class, 'createProduct'])->middleware(Authenticate::class);
    Route::put('/{id}', [productController::class, 'updateProduct'])->middleware(Authenticate::class);
    Route::delete('/{id}', [productController::class, 'deleteProduct'])->middleware(Authenticate::class);

    Route::get('/user/{userId}', [productController::class, 'showProductsByUser'])->middleware(Authenticate::class);
});

Route::prefix('offers')->group(function(){
    Route::get('/', [offerController::class, 'index'])->middleware(Authenticate::class);
    Route::get('/{id}', [offerController::class, 'showOffer'])->middleware(Authenticate::class);
    Route::post('/', [offerController::class, 'createOffer'])->middleware(Authenticate::class);
    Route::put('/{id}', [offerController::class, 'updateOffer'])->middleware(Authenticate::class);
    Route::delete('/{id}', [offerController::class, 'deleteOffer'])->middleware(Authenticate::class);

    Route::get('/user/{userId}', [offerController::class, 'showOffersByUser'])->middleware(Authenticate::class);
});

Route::prefix('messages')->group(function(){
    Route::get('/', [messageController::class, 'index'])->middleware(Authenticate::class);
    Route::get('/{id}', [messageController::class, 'showMessage'])->middleware(Authenticate::class);
    Route::post('/', [messageController::class, 'createMessage'])->middleware(Authenticate::class);
    Route::put('/{id}', [messageController::class, 'updateMessage'])->middleware(Authenticate::class);
    Route::delete('/{id}', [messageController::class, 'deleteMessage'])->middleware(Authenticate::class);

    //Remitente (los mensajes que ha enviado el usuario)
    Route::get('/user/{userId}', [messageController::class, 'showMessagesByUser'])->middleware(Authenticate::class);
    //Destinatario (los mensajes que ha recibido el usuario)
    Route::get('/recipient/{userId}', [messageController::class, 'showMessagesByRecipient'])->middleware(Authenticate::class);
});

Route::prefix('favorites')->group(function(){
    Route::get('/', [favoriteController::class, 'index'])->middleware(Authenticate::class);
    Route::get('/{id}', [favoriteController::class, 'showFavorite'])->middleware(Authenticate::class);
    Route::post('/', [favoriteController::class, 'createFavorite'])->middleware(Authenticate::class);
    Route::put('/{id}', [favoriteController::class, 'updateFavorite'])->middleware(Authenticate::class);
    Route::delete('/{id}', [favoriteController::class, 'deleteFavorite'])->middleware(Authenticate::class);

    Route::get('/user/{userId}', [favoriteController::class, 'showFavoritesByUser'])->middleware(Authenticate::class);
    // Obtener todos los usuarios que han marcado un producto como favorito
    Route::get('/product/{productId}', [favoriteController::class, 'showFavoritesByProduct'])->middleware(Authenticate::class);
    // Obtener todos los productos que un usuario ha marcado como favoritos
    Route::get('/user/{userId}/product', [favoriteController::class, 'showFavoritesByUserAndProduct'])->middleware(Authenticate::class);
    // Obtener la cantidad de veces que un producto ha sido marcado como favorito
    Route::get('/product/{productId}/count', [favoriteController::class, 'countFavoritesByProduct'])->middleware(Authenticate::class);
});

Route::prefix('users')->group(function(){
    Route::get('/', [userController::class, 'index'])->middleware(Authenticate::class);
    Route::get('/{id}', [userController::class, 'showUser'])->middleware(Authenticate::class);
    Route::put('/{id}', [userController::class, 'updateUser'])->middleware(Authenticate::class);
    Route::delete('/{id}', [userController::class, 'deleteUser'])->middleware(Authenticate::class);
});