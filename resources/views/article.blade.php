@extends('layouts.page')
@section('title', $article->TITLE)

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">

    <script src="{{ asset('javascript/likes.js') }}" defer></script>
    <script src="{{ asset('javascript/comment.js') }}" defer></script>
    <script src="{{ asset('javascript/sandwich_btn.js') }}" defer></script>
    <script>
        var article = @json($article->ID);
    </script>
@endsection

@section('page')
    <section>
        <div id="article_img" style="background-image: url({{ $article->IMAGE_URL }})">
        </div>
        <div id="title_sec">
            <div id="article_title" class="title">{{ $article->TITLE }}</div>
            <div type="text" name="city" id="city_sec">
                <i class="fi fi-rr-marker"></i>
                {{ $article->CITY }}
                <br>
                <i class="fi fi-rr-circle-user"></i>
                <a href="/account/{{ $article->author->USERNAME }}">
                    {{ $article->author->USERNAME }}
                </a>
            </div>
        </div>
        <div id="article_body">
            {{ $article->CONTENT }}
        </div>

        @if ($username === $article->author->USERNAME)
            <a id='delete_btn' href='/delete_article/{{ $article->ID }}'>
                Elimina questo articolo
            </a>
        @endif


        <div id="reaction_sec">
            <div id="stats">
                <div id="likes">
                    <img src="{{ asset('img/star.png') }}">
                    <div id="num_like">
                        {{ count($article->likes) }}
                    </div>
                </div>

                <div id="comments">
                    <img src="{{ asset('img/comment.png') }}">
                    <div id="num_comment">
                        {{ count($article->comments) }}
                    </div>
                </div>
            </div>
        </div>

        <div id="comment_section" class="hidden">
            <form name="comment">
                @csrf
                <input type="hidden" name="token" value="{{ csrf_token() }}">
                <div class="comment">
                    <div class="author">
                        {{ $username }}
                    </div>
                    <div class="text">
                        <textarea name="comment_content" cols="30" rows="10"></textarea>
                    </div>
                    <div class="date">
                        {{ date('d-m-Y') }}
                    </div>
                </div>

                <button type="submit">
                    Pubblica
                </button>
            </form>
            <hr>

            <div id="comment_list">

            </div>
        </div>

    </section>

@endsection
