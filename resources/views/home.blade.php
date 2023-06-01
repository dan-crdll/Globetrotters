@extends('layouts.page')
@section('title', 'Home')

@section('head')
    @parent

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/article_list.css') }}">
    <script src="{{ asset('javascript/home.js') }}" defer></script>

@endsection

@section('page')
    <div id="search_container">
        <form name="search_form">
            <div id="search_bar">
                <label for="search_bar">
                    <button type="submit">
                        <i class="fi fi-rr-search-location"></i>
                    </button>
                </label>
                <input type="text" name="search_bar">
            </div>
        </form>
    </div>

    <section>
        <div id="section-title">
            Lasciati ispirare
        </div>
        <div id="section-subtitle">
            Ultimi tweet dell'account <span class="hashtag">Trip Advisor</span> e articoli più popolari
        </div>
        <br>
        <div id="article-container" class="page">
            <div id="populars">
                <div id="most_popular">

                </div>
            </div>

            <div id="article-list">
                
            </div>
        </div>

        <div id="hourglass">
            <img src="{{ asset('img/hourglass.gif') }}" class="hidden">
        </div>

        <div id="modal_view" class="hidden">
            <div class="page">
                
            </div>
        </div>
    </section>
@endsection
