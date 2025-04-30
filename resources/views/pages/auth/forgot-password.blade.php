@php
    $customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/blankLayout')

@section('title', 'Mot de passe oublié')

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
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link">
                                <span
                                    class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
                                <span
                                    class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Forgot Password? 🔒</h4>
                        <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')"/>
                        <form id="formAuthentication" class="mb-6" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">{{__('Email')}}</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter your email"
                                       name="email" :value="old('email')" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <button class="btn btn-primary d-grid w-100">{{ __('Email Password Reset Link') }}</button>
                        </form>
                        <div class="text-center">
                            <a href="{{route("login")}}" class="d-flex justify-content-center">
                                <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
