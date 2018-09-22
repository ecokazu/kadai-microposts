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
    
    
    
}
