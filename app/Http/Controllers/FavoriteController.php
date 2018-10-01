<?php
//favoriteを制御するコントローラー

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //Userのfavorite（）で記事にお気に入りする
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return redirect()->back();
    }
    
}
