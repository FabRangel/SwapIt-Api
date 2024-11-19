<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class messageController extends Controller
{
    public function index(){
        $messages = message::all();
        if($messages->isEmpty()){
            return response()->json([
                'message' => 'No messages found'
            ]);
        }
        return response()->json($messages);
    }

    public function showMessage($id){
        $message = message::find($id);
        if(!$message){
            return response()->json([
                'error' => 'Mensaje no encontrado'
            ], 500);
        }
        return response()->json($message);
    }

    public function createMessage(Request $request){
        $message = message::create($request->all());
        return response()->json($message);
    }

    public function updateMessage(Request $request, $id){
        $message = message::find($id);
        if(!$message){
            return response()->json([
                'error' => 'Mensaje no encontrado'
            ], 500);
        }
        $message->update($request->all());
        return response()->json($message);
    }

    public function deleteMessage($id){
        $message = message::find($id);
        if(!$message){
            return response()->json([
                'error' => 'Mensaje no encontrado'
            ], 500);
            //return response()->json(['message' => 'Error al registrar el usuario.'], 500);
        }
        $message->delete();
        return response()->json([
            'message' => 'Message deleted successfully'
        ]);
    }

    public function showMessagesByUser($userId){
        $messages = message::where('id_user', $userId)->get();
        if($messages->isEmpty()){
            return response()->json([
                'message' => 'No messages found'
            ]);
        }
        return response()->json($messages);
    }
    
}
