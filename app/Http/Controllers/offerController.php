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
                'error' => 'Offer not found'
            ]);
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
                'error' => 'Offer not found'
            ]);
        }
        $offer->update($request->all());
        return response()->json($offer);
    }

    public function deleteOffer($id){
        $offer = offer::find($id);
        if(!$offer){
            return response()->json([
                'error' => 'Offer not found'
            ]);
        }
        $offer->delete();
        return response()->json([
            'message' => 'Offer deleted successfully'
        ]);
    }

    public function showOffersByUser($userId){
        $offers = offer::where('id_user', $userId)->get();
        if($offers->isEmpty()){
            return response()->json([
                'message' => 'No offers found'
            ]);
        }
        return response()->json($offers);
    }
}
