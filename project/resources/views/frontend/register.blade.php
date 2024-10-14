@extends('layouts.front')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/front/css/signUp.css') }}">
@endsection
@section('content')

<div class="signuppage">
    <div class="signup-container">
        <div class="signup-box">
            <h2>Welcome <span>Back</span></h2>
            @include('includes.admin.form-login')
            <p>Login to your account using below details</p>
            <form action="{{ route('user-register-submit') }}" method="POST" id="registerform">
                @csrf
                <div class="inputwrapper">
                    <input type="text" name="name" placeholder="Full Name" required>

                </div>
                <div class="inputwrapper">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="number" name="phone" placeholder="Phone" required>
                </div>
                <div class="inputwrapper">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="signup-btn">REGISTER</button>
            </form>
            <p class="login-text">Already have an account? <a href="#" class="login-link">Login</a></p>
        </div>
    </div>
</div>
@endsection

@section('script')


@endsection