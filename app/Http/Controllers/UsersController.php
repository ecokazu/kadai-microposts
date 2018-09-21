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
        
        return view('users.show', [
            'user' => $user,
        ]);
        
    }
    
}
