@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Connexion')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/@form-validation/form-validation.scss'
    ])
@endsection

@section('page-style')
    @vite([
      'resources/assets/vendor/scss/pages/page-auth.scss'
    ])
@endsection

@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js'
    ])
@endsection

@section('page-script')
    @vite([
      'resources/assets/js/pages-auth.js'
    ])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link">
                                <span
                                    class="app-brand-logo demo">@include('_partials.macros')</span>
                                <span
                                    class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Bienvenue à {{ config('variables.templateName') }}! 👋</h4>
                        <p class="mb-6">Veuillez vous connecter à votre compte et commencer l'aventure</p>

                        <form id="formAuthentication" class="mb-4" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" id="email" type="email" name="email" :value="old('email')"
                                       required value="admin@admin.com" autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Mot de passe</label>
                                <div class="input-group input-group-merge">
                                    <input value="password" type="password" id="password"
                                           required autocomplete="current-password"
                                           class="form-control" name="password"
                                           placeholder=""/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            </div>
                            <div class="my-8">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" name="remember" type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me">
                                            Souviens-toi de moi
                                        </label>
                                    </div>
                                    @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                        <a href="{{route('password.request')}}">
                                            <p class="mb-0">Mot de passe oublié?</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Se connecter</button>
                            </div>
                        </form>

                        {{--<p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{route("register")}}">
                                <span>Create an account</span>
                            </a>
                        </p>--}}
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection

