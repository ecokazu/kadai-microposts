<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    
     public function microposts()
    {
        //リレー設定
        return $this->hasMany(Micropost::class);
    }
    

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    
    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    public function is_following($userId) {
        //idをチェックしてexists()で、あればtrue　なければfalseを返す
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    
    public function feed_microposts()
    {
        //userがフォローしているuserのidを取得
        $follow_user_ids=$this->followings()->pluck('users.id')->toArray();
        //自分のidも追加
        $follow_user_ids[]=$this->id;
        
        //全user_idからfollow_user_idsのidを取得
        return Micropost::whereIn('user_id',$follow_user_ids);
    }



    ////お気に入りの処理
    public function self_favorite()
    {
        //自分がお気に入りしているリストを返す
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id','micropost_id')->withTimestamps();
    }
    
    
    
    public function favorite($postId)
    {
            // 既にお気に入りしているかの確認
            $exist = $this->is_favorite($postId);
            // 自分自身ではないかの確認
            $its_me = $this->id == $postId;
        
            if ($exist || $its_me) {
                // 既にしていれば何もしない
                return false;
            } else {
                // 未お気に入りなら処理する
                $this->self_favorite()->attach($postId);
                return true;
            }
    }
    
   
 
 
    //お気に入りの取り消し 
     public function unfavorite($postId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_favorite($postId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $postId;
    
        if ($exist && !$its_me) {//いいねidして、自分の記事じゃない場合。お気に入り消す
            
            $this->self_favorite()->detach($postId);
            return true;
            
        } else {
            // 未お気に入りであれば何もしない
            return false;
        }
    }
     
 
  //引数のIDから記事にお気に入りしているかexists()で判定　あればtrueを返す
    public function is_favorite($postId)
    {
        
        return $this->self_favorite()->where('micropost_id', $postId)->exists();
    }
    

        
     
    
    
}
