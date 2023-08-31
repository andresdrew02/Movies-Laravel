@extends('layouts.guest')
@section('title', 'Registrarse')
@section('content')
<style>
    .register-form-wrapper {
        width:100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items:center;
    }
    .register-form{
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .register-form img{
        width: 100px;
        height: auto;
    }
</style>
<div class="register-form-wrapper">
    <div class="register-form">
        <a href="/">
            <img src="https://drive.google.com/uc?id=1J0h-XO72QZiuFUbRwqTHvyBdTCvQed20" alt="Logo de Movienator">
        </a>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre de usuario')" />
                <x-text-input id="name" class="input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" class="input"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirma su contraseña')" />

                <x-text-input id="password_confirmation" class="input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div style="display:flex; flex-direction:column; gap:1em;">
                <a href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <x-primary-button class="button is-primary is-light">
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
