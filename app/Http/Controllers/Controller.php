<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public function counts($user) {
        
        //投稿記事のカウント
        $count_microposts = $user->microposts()->count();

        //フォローフォロワー数のカウント
        $count_followings = $user->followings()->count();

        $count_followers = $user->followers()->count();

        //自分がお気に入りしている数
         $count_self_favorites = $user->self_favorite()->count();
    
        
    
        return [
            'count_microposts' => $count_microposts,
             'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_self_favorites' => $count_self_favorites,
            
        ];
    }
    
    public function post_counts($postId) {
        
    
    //記事にお気に入りしている数
        $count_self_favorites = $postId->post_favorite()->count();
    
     return [
         'count_post_favorite' => $count_post_favorites,
         
        ];
    }
    
}
