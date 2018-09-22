<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    //
    public function index()
    {
        $user = User::paginate(1);
        
        return view('users.index',[
            'users'=>$user,
            ]);
        
    }
    
    public function show($id)
    {
        $user=User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];
        
        
        $data += $this->counts($user);
        
         return view('users.show', $data);
    }
    
}
