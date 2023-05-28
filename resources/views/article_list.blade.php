@extends('layouts.page')

@section('title', 'Esplora gli articoli')

@section('head')
    @parent

    <link rel="stylesheet" href="{{ asset('css/article_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list_footer.css') }}">

    <script src="{{ asset('javascript/article_creation.js') }}" defer></script>
    <script src="{{ asset('javascript/sandwich_btn.js') }}" defer></script>

@endsection

@section('page')
    <section class="page">
        @if (count($articles))
            @foreach ($articles as $article)
                <a class="article" href="article/{{ $article['ID'] }}">
                    <div class="image_article" style="background-image: url('{{ $article['IMAGE_URL'] }}')"></div>
                    <div class="article_title">
                        {{ $article['TITLE'] }}
                    </div>
                </a>
            @endforeach
        @else
            <div class="non_found">
                Non ci sono articoli da mostrare...
            </div>
        @endif
    </section>
@endsection
