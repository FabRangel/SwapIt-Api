<?php

namespace App\Http\Controllers;

use App\Models\offer;
use App\Models\product;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function index(){
        $products = product::all();
        if($products->isEmpty()){
            return response()->json([
                'message' => 'No products found'
            ]);
        }
        return response()->json($products);
    }

    public function showProduct($id){
        $product = product::find($id);
        if(!$product){
            return response()->json([
                'error' => 'Producto no encontrado'
            ], 500);
        }
        return response()->json($product);
    }

    public function createProduct(Request $request){
        try{
            $product = product::create($request->all());
            return response()->json($product, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Código de error 500
        }
    }

    public function updateProduct(Request $request, $id){
        $product = product::find($id);
        if(!$product){
            return response()->json([
                'error' => 'Producto no encontrado'
            ], 500);
        }
        $product->update($request->all());
        return response()->json($product);
    }

    public function deleteProduct($id){
        $product = product::find($id);
        if(!$product){
            return response()->json([
                'error' => 'Producto no encontrado'
            ], 500);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function showProductsByUser($userId){
        $products = product::where('id_user', $userId)->get();
        if($products->isEmpty()){
            return response()->json([
                'error' => 'No products found'
            ],500);
        }
        return response()->json($products);
    }

    public function showRecentProducts(){
         $products = DB::table('products')
         ->leftJoin('favorites', 'products.id', '=', 'favorites.id_product')
         ->select(
             'products.id as product_id',
             'products.name as product_name',
             'products.description',
             'products.image1',
             'products.created_at as product_created_at',
             DB::raw('COUNT(favorites.id) as favorites_count')
         )
         ->groupBy('products.id')
         ->orderBy('products.created_at', 'desc')
         ->limit(5)
         ->get();

     if ($products->isEmpty()) {
         return response()->json([
             'message' => 'No products found'
         ]);
     }

     return response()->json($products);
    }

    public function countProductsByUser($userId){
        $products = product::where('id_user', $userId)->count();
        return response()->json($products);
    }

    public function countProductsByOffer($id){
        $products = offer::where('id_product', $id)->count();
        return response()->json($products);
    }

    public function getProductsWithOfferCount($id){
        $products = DB::table('products')
        ->leftJoin('offers', 'products.id', '=', 'offers.id_product')
        ->where('products.id_user', '=', $id)
        ->select(
            'products.id as id',
            'products.name as name',
            'products.description',
            'products.image1',
            'products.status',
            'products.created_at as created_at',
            DB::raw('COUNT(offers.id) as offers_count')
        )
        ->groupBy('products.id')
        ->get();

        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'No products found'
            ]);
        }

        return response()->json($products);
    }
}
