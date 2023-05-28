@extends('layouts.landing')

@section('title', 'Signup')

@section('message', 'Che bello averti a bordo!')

@section('errors')
    @if ($errors->any())
        <span class="error">Errori nella compilazione del form</span>
    @endif
@endsection

@section('form')
    <form method="post" name="signup_form" action="/signup">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="name">Nome <span class="error hidden" id="name_error">
                Nome non valido o troppo lungo.
            </span></label>
        <input type="text" id="name" name="name">
        <label for="surname">Cognome <span class="error hidden" id="surname_error">
                Cognome non valido o troppo lungo.
            </span></label>
        <input type="text" id="surname" name="surname">
        <label for="username">Username <span class="error hidden" id="username_error">
                Username non valido o già utilizzato
            </span></label>
        <input type="text" id="username" name="username">
        <label for="email">Email <span class="error hidden" id="email_error">
                Email non valida o già utilizzata
            </span></label>
        <input type="email" id="email" name="email">
        <label for="password">Password <span class="error hidden" id="password_error">
            Lunghezza: 8, contenere maiuscole, minuscole, numeri e caratteri speciali
            </span></label>
        <input type="password" id="password" name="password">

        <button type="submit" id="su_btn">Registrati</button>
    </form>
@endsection

@section('to_other_link')
    <a href="login" id="toLoginLink">
        Sei già un globetrotter? Accedi!
    </a>
@endsection
