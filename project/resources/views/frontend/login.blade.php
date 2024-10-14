@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/login.css') }}">
@endsection
@section('content')


<div class="loginPage">
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome <span>Back</span></h2>
            <p>Login to your account using below details</p>
            <div class="alert alert-info validation" style="display: none;">
                <p class="text-left"></p>
            </div>
            <div class="alert alert-success validation" style="display: none;">
                <button type="button" class="close alert-close"><span>×</span></button>
                <p class="text-left"></p>
            </div>
            <div class="alert alert-danger validation" style="display: none;">
                <button type="button" class="close alert-close"><span>×</span></button>
                <p class="text-left"></p>
            </div>
            <form action="{{ route('user.login.submit') }}" method="POST" id="loginform">
                @csrf
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#" class="forgot-password">Forgot Password?</a>
                <button type="submit" class="login-btn">LOG IN</button>
            </form>
            <p class="signup-text">Don't have an account? <a href="{{ route('user.register') }}" class="signup-link">Sign up</a></p>
        </div>
    </div>
</div>
@endsection

@section('script')


@endsection