
{{--　本人の記事にお気に入りボタンを出さない場合 --}}
{{--　@if (Auth::id() != $micropost->user_id) --}}



    @if (Auth::user()->is_favorite($micropost->id))
    <!--記事がお気に入りしていたら　アンフォローボタン表示-->
    
        {!! Form::open(['route' => ['Favorite.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            
            
            <button type="submit" class="btn btn-danger">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            お気に入りを消す
           </button>
           
        {!! Form::close() !!}
        
    @else
   <!-- 記事がお気に入りしていなかったら　フォローボタン表示-->
    
        {!! Form::open(['route' => ['Favorite.favorite', $micropost->id]]) !!}
            
            
           <button type="submit" class="btn btn-primary">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            お気に入り
           </button>
           
          
           
        {!! Form::close() !!}
    
    @endif
    
    
{{--　@endif --}}