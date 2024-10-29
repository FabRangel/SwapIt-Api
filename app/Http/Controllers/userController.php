<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){
        $users = User::all();
        if($users->isEmpty()){
            return response()->json([
                'message' => 'No users found'
            ]);
        }
        return response()->json($users);
    }

    public function showUser($id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'error' => 'User not found'
            ]);
        }
        return response()->json($user);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'error' => 'User not found'
            ]);
        }
        $user->update($request->all());
        return response()->json($user);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'error' => 'User not found'
            ]);
        }
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }


}
