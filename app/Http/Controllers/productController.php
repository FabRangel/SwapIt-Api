<?php

namespace App\Http\Controllers;

use App\Models\product;
use Error;
use Illuminate\Http\Request;

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
                'message' => 'No products found'
            ]);
        }
        return response()->json($products);
    }
}
