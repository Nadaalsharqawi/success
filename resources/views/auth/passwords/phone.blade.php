@extends('auth.auth_layout')
@section('title' , 'ارسال كلمة المرور')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">ارسال كود الي رقم الجوال</h1>
    @if(session()->has('status'))
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-text">
                {{session()->get('status')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    @error('email')
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-text">
                {{$message}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
        @enderror
        <form class="mt-4" method="POST" action="{{ route('send.code') }}">
            @csrf

            <div class="form-group">
                <label for="phone">رقم الجوال</label>
                <input id="phone" type="phone" class="form-control  mb-0 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary float-right">
                    ارسال
                </button>
            </div>
        </form>
</div>
@endsection

