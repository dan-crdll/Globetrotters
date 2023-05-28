@extends('layouts.page')

@section('title', $username)

@section('head')
    @parent

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/article_list.css') }}">

    <script src="{{ asset('javascript/fetch_random_pic.js') }}" defer></script>

@endsection

@section('page')
    <div id="prof_img"></div>
    <div id="info">
        <div id="name">
            {{ $name . ' ' . $surname }}
        </div>
        <div id="username">
            {{ '@' . $username }} -
            {{ $followers . ' ' . ($followers > 1 ? 'Followers' : 'Follower') }}
            <img id="follow_ico" src="{{ asset('img/full_following.png') }}">
        </div>
    </div>

    <div id="profile_content">
        <div class="section_title">
            <i class="fi fi-rr-plane-alt"></i>
            Contributi
        </div>
        <div id="articles">
            @if (count($articles))
                @foreach ($articles as $article)
                    <a href="/article/{{ $article->ID }}" class="article">
                        <div class="image_article" style="background-image: url('{{ $article->IMAGE_URL }}')">
                        </div>
                        <div class="article_title">
                            {{ $article->TITLE }}
                        </div>
                    </a>
                @endforeach
            @else
                Non hai ancora caricato alcun contributo...
            @endif
        </div>

        <hr>

        <div class="section_title">
            <i class="fi fi-rr-star"></i>
            Mi piace
        </div>

        <div class="page">
            @if (count($likes))
                @foreach ($likes as $like)
                    <a href="/article/{{ $like->article->ID }}" class="article">
                        <div class="image_article" style="background-image: url('{{ $like->article->IMAGE_URL }}')">
                        </div>
                        <div class="article_title">
                            {{ $like->article->TITLE }}
                        </div>
                    </a>
                @endforeach
            @else
                Non hai ancora messo mi piace a nulla...
            @endif
        </div>

        <hr>

        <div class="section_title">
            <i class="fi fi-rr-following"></i>
            Seguiti
        </div>

        <div id="followed_list">
            @if (count($followings))
                @foreach ($followings as $following)
                    <a class="account" href="/account/{{ $following->followed->USERNAME }}">
                        {{ '@' . $following->followed->USERNAME }}
                    </a>
                @endforeach
            @else
                Non segui nessuno... esplora!
            @endif
            <!--
                                if (mysqli_num_rows($res) === 0) {
                                    echo 'Non segui nessuno... esplora!';
                                } else {
                                    for ($i = 0; $i < mysqli_num_rows($res); $i++) {
                                        $entry = mysqli_fetch_assoc($res);
                                        echo '<a class="account" href="account.php?user=' . $entry['USERNAME'] . '">';
                                        echo '@' . $entry['USERNAME'];
                                        echo '</a>';
                                    }
                                }-->
        </div>
    </div>
@endsection
