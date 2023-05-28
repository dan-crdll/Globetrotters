@extends('layouts.page')
@section('title', 'Write an Article')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/article_creation.css') }}">

    <script src="{{ asset('javascript/article_creation.js') }}" defer></script>
@endsection

@section('page')
    <form action="article_create" method="post" name="article_creation">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="image_url">
        <section>
            <div id="article_img"></div>
            <div id="title_sec">
                <input class="title" type="text" name="article_title" id="article_title" value="Inserisci il titolo">

                @isset($error)
                    <div class="error">
                        Problema nella creazione dell'articolo, forse ne esiste già uno con lo stesso nome?
                    </div>
                @endisset

                <label for="city_sec">
                    Luogo
                    <input type="text" name="city" id="city_sec">
                </label>
            </div>
            <textarea name="article_body" id="article_body"></textarea>

            <button id="save_btn" type="submit">
                Pubblica
            </button>
        </section>
    </form>
@endsection
