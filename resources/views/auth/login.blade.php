@extends('auth.auth_layout')
@section('title' , 'تسجيل الدخول')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">تسجيل الدخول</h1>
    @if(session()->has('status'))
        <div class="alert text-white bg-primary" role="alert">
            <div class="iq-alert-text">
                {{session()->get('status')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-text">
                {{session()->get('error')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    <form class="mt-4" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="phone">رقم الجوال</label>
            <input type="tel" class="form-control mb-0" id="phone" placeholder=" رقم الجوال" name="phone" value="{{ old('phone') }}" required autocomplete="off" autofocus>
            @error('phone')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">كلمة المرور</label>
            {{-- @if (Route::has('password.request'))
                <a class="float-right" href="{{ route('forget.password.get') }}">
                    نسيت كلمة المرور
                </a>
            @endif --}}
            <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="كلمة المرور" name="password" required autocomplete="current-password">
            @error('password')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div class="d-inline-block w-100">
            <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                <input type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember"  class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">تذكرني</label>
            </div>
            <button type="submit" class="btn btn-primary float-right">تسجيل الدخول</button>
        </div>
    </form>
</div>
@endsection
