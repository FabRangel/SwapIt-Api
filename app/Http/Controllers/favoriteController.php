<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use Illuminate\Http\Request;

class favoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::all();
        return response()->json($favorites, 200);
    }

    public function showFavorite($id)
    {
        $favorite = Favorite::find($id);
        if (!$favorite) {
            return response()->json(['error' => 'Favorito no encontrado'], 404);
        }
        return response()->json($favorite, 200);
    }

    public function createFavorite(Request $request)
    {
        $favorite = Favorite::create($request->all());
        return response()->json($favorite, 201);
    }

    public function updateFavorite(Request $request, $id)
    {
        $favorite = Favorite::find($id);
        if (!$favorite) {
            return response()->json(['error' => 'Favorito no encontrado'], 404);
        }
        $favorite->update($request->all());
        return response()->json($favorite, 200);
    }

    public function deleteFavorite($id)
    {
        $favorite = Favorite::find($id);
        if (!$favorite) {
            return response()->json(['error' => 'Favorito no encontrado'], 404);
        }
        $favorite->delete();
        return response()->json(['message' => 'Favorite deleted successfully'], 200);
    }

    public function showFavoritesByUser($userId)
    {
        $favorites = Favorite::where('id_user', $userId)->get();
        return response()->json($favorites, 200);
    }

    public function showFavoritesByProduct($productId)
    {
        $favorites = Favorite::where('id_product', $productId)->get();
        return response()->json($favorites, 200);
    }

    public function showFavoritesByUserAndProduct($userId, $productId)
    {
        $favorites = Favorite::where('user_id', $userId)->where('product_id', $productId)->get();
        return response()->json($favorites, 200);
    }

    public function countFavoritesByProduct($productId)
    {
        $count = Favorite::where('id_product', $productId)->count();
        return response()->json(['count' => $count], 200);
    }
    
}
