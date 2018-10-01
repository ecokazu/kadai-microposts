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

    public function followings($id)
        {
            $user = User::find($id);
            $followings = $user->followings()->paginate(10);
    
            $data = [
                'user' => $user,
                'users' => $followings,
            ];
    
            $data += $this->counts($user);
    
            return view('users.followings', $data);
        }
    
        public function followers($id)
        {
            $user = User::find($id);
            $followers = $user->followers()->paginate(10);
    
            $data = [
                'user' => $user,
                'users' => $followers,
                
            ];
    
            $data += $this->counts($user);
    
            return view('users.followers', $data);
        }

    
    
    //お気に入りの取得
    public function self_favorite($id)
    {
         $user = User::find($id);
         //お気に入りしているリストを返す
         $self_favorites=$user->self_favorite()->paginate(10);
         $data = [
                'user' => $user,
                'self_favorites' => $self_favorites,
                
                
            ];
            
            $data += $this->counts($user);
            
            
            return view('users.self_favorite', $data);
    }
    
    
    
    
    
}
