<?php

namespace App\Http\Controllers;

use App\Models\offer;
use Illuminate\Http\Request;

class offerController extends Controller
{
    public function index(){
        $offers = offer::all();
        if($offers->isEmpty()){
            return response()->json([
                'message' => 'No offers found'
            ]);
        }
        return response()->json($offers);
    }

    public function showOffer($id){
        $offer = offer::find($id);
        if(!$offer){
            return response()->json([
                'error' => 'Oferta no encontrada'
            ], 500);
        }
        return response()->json($offer);
    }

    public function createOffer(Request $request){
        $offer = offer::create($request->all());
        return response()->json($offer);
    }

    public function updateOffer(Request $request, $id){
        $offer = offer::find($id);
        if(!$offer){
            return response()->json([
                'error' => 'Oferta no encontrada'
            ], 500);
        }
        $offer->update($request->all());
        return response()->json($offer);
    }

    public function deleteOffer($id){
        $offer = offer::find($id);
        if(!$offer){
            return response()->json([
                'error' => 'Oferta no encontrada'
            ]);
        }
        $offer->delete();
        return response()->json([
            'message' => 'Offer deleted successfully'
        ]);
    }

    public function showOffersByUser($userId){
        $offers = offer::where('id_user_offer', $userId)->get();
        if($offers->isEmpty()){
            return response()->json([
                'message' => 'No offers found'
            ]);
        }
        return response()->json($offers);
    }

    public function showOffersByProduct($productId){
        $offers = offer::where('id_product', $productId)->get();
        if($offers->isEmpty()){
            return response()->json([
                'message' => 'No offers found'
            ]);
        }
        return response()->json($offers);
    }
}
