@extends('layouts.page')
@section('title', $account->USERNAME)

@section('head')
    @parent
    <script src="{{ asset('javascript/fetch_random_pic.js') }}" defer></script>
    <script src="{{ asset('javascript/add_follow.js') }}" defer></script>

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/article_list.css') }}">

    <script>
        var user = @json($account->USERNAME);
    </script>
@endsection

@section('page')
    <div id="prof_img"></div>
    <div id="info">
        <div id="name">
            @ {{ $account->USERNAME }}
        </div>
        <div id="follow">
            <img>
            <div id="num_follow">
                {{ $followers->count() }}
            </div>
        </div>
    </div>

    <div id="profile_content">
        <div class="section_title">
            <i class="fi fi-rr-plane-alt"></i>
            Contributi
        </div>
        <div id="articles">
            @if (count($contributions) > 0)
                @foreach ($contributions as $contribute)
                    <a class="article" href='/article/{{ $contribute->ID }}'>
                        <div class="image_article" style="background-image: url('{{ $contribute->IMAGE_URL }}')">
                        </div>
                        <div class="article_title">{{ $contribute->TITLE }}</div>
                    </a>
                @endforeach
            @else
                Questo utente non ha ancora contribuito...
            @endif
        </div>

        <hr>
    </div>
@endsection
