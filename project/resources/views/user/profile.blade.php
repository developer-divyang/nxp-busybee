@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/profile.css')}}">
@endsection
@section('content')
<div class="profileContent">
   <div class="profileContentWrapper">
      <div class="form-wrapper">
         <div class="profile-card">
            <h2>Edit <span>Profile</span></h2>
            <div class="avatar-section">
               <img src="{{asset('assets/front/images/blog1.png') }}" alt="Profile Picture">
               <span class="icon-pencil">✏️</span>
            </div>
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
            <form method="POST" id="userform" action="{{ route('user-profile-update') }}">
               @csrf
               <div class="field-container">
                  <input type="text" placeholder="David" name="name" value="{{ Auth::user()->name }}" required>
               </div>
               <!-- <div class="field-container">
                  <input type="text" placeholder="Wilson" required>
               </div> -->
               <div class="field-container">
                  <input type="email" placeholder="Davidwilson77@gmail.com" name="email" value="{{ Auth::user()->email }}" required>
               </div>
               <div class="field-container">
                  <input type="tel" placeholder="210 679 7109" name="phone" value="{{ Auth::user()->phone }}" required>
               </div>
               <h2>Update <span>Password</span></h2>
               <div class="field-container">
                  <input type="password" placeholder="Old Password" name="old_password">
               </div>
               <div class="field-container">
                  <input type="password" placeholder="New Password" name="password">
               </div>
               <div class="field-container">
                  <input type="password" placeholder="Confirm Password" name="password_confirmation">
               </div>
               <div class="formBtnWrapper">
                  <button type="submit" class="btn-save">SAVE</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
@section('script')
@endsection