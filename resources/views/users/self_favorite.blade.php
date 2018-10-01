@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user])
        </aside>
         <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">TimeLine <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/self_favorite') ? 'active' : '' }}"><a href="{{ route('users.self_favorite', ['id' => $user->id]) }}">self_favorite <span class="badge">{{ $count_self_favorites }}</span></a></li>
            </ul>
          
            
            
            <!--お気に入りしている記事一覧の表示-->
          @if (count($self_favorites) > 0)
            <ul class="media-list">
            @foreach ($self_favorites as $self_favorite)
                <li class="media">
                    <div class="media-left">
                        <img class="media-object img-rounded" src="{{ Gravatar::src($self_favorite->email, 50) }}" alt="">
                    </div>
                    <div class="media-body">
                        <div>
                            {{ $self_favorite->user->name }}
                        </div>
                        <div>
                           記事ID:{{ $self_favorite->id }}: {{ $self_favorite->content }}
                        </div>
                        <div>
                            
                          @include('favorite.favorite_button', ['micropost' => $self_favorite]) 
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
            {!! $self_favorites->render() !!}
            @endif
            
        </div>
    </div>
@endsection