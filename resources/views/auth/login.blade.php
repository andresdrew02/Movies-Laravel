@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<style>
    .login-form{
        display: flex;
        flex-direction: column;
        gap:1em;
        justify-content: center;
        align-items: center;
    }

    .login-form img{
        width: 100px;
        height: auto;
    }
    .login-form-wrapper{
        width: 100%;
        height: 100vh;
        display:flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="login-form-wrapper">
    <div class="login-form">
        <div>
            <a href="/">
                <img src="{{ asset('draw.png') }}" alt="Logo de Movienator">
            </a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')"/>
        
                <x-text-input id="password" class="input"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
        
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        
            <!-- Remember Me -->
            <div>
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div>
                <a href="{{ route('register') }}">
                    {{ __('¿No tiene una cuenta?') }}
                </a>
            </div>
        
            <div style="display: flex; flex-direction: column; gap: 1em; margin-top:1em;">
                <x-primary-button class="button is-primary is-light">
                    {{ __('Iniciar sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection