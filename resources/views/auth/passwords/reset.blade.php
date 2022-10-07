@extends('auth.auth_layout')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">تاكيد الكود</h1>
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
    <form class="mt-4" method="post" action="{{ route('check.code.post') }}">
        @csrf
        <div class="form-group">
            <label for="phone" >رقم الجوال</label>
            <input id="phone" type="phone" class="form-control mb-0 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="off" autofocus>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="code">الكود</label>
            <input id="code" type="text" class="form-control mb-0 @error('code') is-invalid @enderror" name="code" required autocomplete="off">
            @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-left">
                ارسال الكود
            </button>
        </div>
    </form>
</div>
@endsection

