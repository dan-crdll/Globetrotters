@extends('layouts.landing')

@section('title', 'Login')

@section('message', 'Bentornato globetrotter!')

@section('errors')
    @if (isset($error))
        <span class="error">{{ $error }}</span>
    @endif
@endsection

@section('form')
    <form method="post" name="login_form" action="/login">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="username">Username <span class="error hidden" id="username_error">
                Username non valido
            </span></label>
        <input type="text" id="username" name="username">
        <label for="password">Password <span class="error hidden" id="password_error">
                Password non valida
            </span></label>
        <input type="password" id="password" name="password">

        <button type="submit">Log In</button>
    </form>
@endsection

@section('to_other_link')
    <a href="signup" id="toLoginLink">
        Non sei ancora un globetrotter? Registrati!
    </a>
@endsection
