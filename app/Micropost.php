<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //$fillable 一気に値を代入を可能にするために$fillableを定義する（ホワイトリスト
    protected $fillable = ['content', 'user_id'];
    
    
    public function user()
    {
        //リレー設定
        return $this->belongsTo(User::class);
        
    }
    
    
   //  public function post_favorite()
    //{
        //記事にお気に入りしている人リストを返す
     //   return $this->belongsToMany(Micropost::class, 'favorites', 'micropost_id','user_id')->withTimestamps();
    //}
    
    
    
}
