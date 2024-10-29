<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
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
    Route::get('/', [productController::class, 'index']);
    Route::get('/{id}', [productController::class, 'showProduct']);
    Route::post('/', [productController::class, 'createProduct']);
    Route::put('/{id}', [productController::class, 'updateProduct']);
    Route::delete('/{id}', [productController::class, 'deleteProduct']);

    Route::get('/user/{userId}', [productController::class, 'showProductsByUser']);
});

Route::prefix('offers')->group(function(){
    Route::get('/', [offerController::class, 'index']);
    Route::get('/{id}', [offerController::class, 'showOffer']);
    Route::post('/', [offerController::class, 'createOffer']);
    Route::put('/{id}', [offerController::class, 'updateOffer']);
    Route::delete('/{id}', [offerController::class, 'deleteOffer']);

    Route::get('/user/{userId}', [offerController::class, 'showOffersByUser']);
});

Route::prefix('messages')->group(function(){
    Route::get('/', [messageController::class, 'index']);
    Route::get('/{id}', [messageController::class, 'showMessage']);
    Route::post('/', [messageController::class, 'createMessage']);
    Route::put('/{id}', [messageController::class, 'updateMessage']);
    Route::delete('/{id}', [messageController::class, 'deleteMessage']);

    //Remitente (los mensajes que ha enviado el usuario)
    Route::get('/user/{userId}', [messageController::class, 'showMessagesByUser']);
    //Destinatario (los mensajes que ha recibido el usuario)
    Route::get('/recipient/{userId}', [messageController::class, 'showMessagesByRecipient']);
});

Route::prefix('favorites')->group(function(){
    Route::get('/', [favoriteController::class, 'index']);
    Route::get('/{id}', [favoriteController::class, 'showFavorite']);
    Route::post('/', [favoriteController::class, 'createFavorite']);
    Route::put('/{id}', [favoriteController::class, 'updateFavorite']);
    Route::delete('/{id}', [favoriteController::class, 'deleteFavorite']);

    Route::get('/user/{userId}', [favoriteController::class, 'showFavoritesByUser']);
    // Obtener todos los usuarios que han marcado un producto como favorito
    Route::get('/product/{productId}', [favoriteController::class, 'showFavoritesByProduct']);
    // Obtener todos los productos que un usuario ha marcado como favoritos
    Route::get('/user/{userId}/product', [favoriteController::class, 'showFavoritesByUserAndProduct']);
    // Obtener la cantidad de veces que un producto ha sido marcado como favorito
    Route::get('/product/{productId}/count', [favoriteController::class, 'countFavoritesByProduct']);
});

Route::prefix('users')->group(function(){
    Route::get('/', [userController::class, 'index']);
    Route::get('/{id}', [userController::class, 'showUser']);
    Route::put('/{id}', [userController::class, 'updateUser']);
    Route::delete('/{id}', [userController::class, 'deleteUser']);
});