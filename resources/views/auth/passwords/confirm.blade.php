@extends('auth.auth_layout')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">تغير كلمة المرور</h1>
    @if($errors->any())
    <div class="alert text-white bg-danger" role="alert">
        @foreach($errors->all() as $error)
            <div class="iq-alert-text">
                {{$error}}
            </div>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        x
        </button>
    </div>
    @endif
    <form class="mt-4" method="post" action="{{ route('forget.password.post') }}">
        @csrf

        <div class="form-group">
            <label for="phone">رقم الجوال</label>
            {!! Form::text('phone' , isset($data->phone) ? $data->phone : old('phone') , ['id'=>'phone','class'=>'form-control mb-0 is','readonly'=>'readonly' ]) !!}
        </div>

        <div class="form-group">
            <label for="code">الكود</label>
            {!! Form::text('code' , isset($data->code) ? $data->code : old('code') , ['id'=>'code','class'=>'form-control mb-0 is','readonly'=>'readonly' ]) !!}
        </div>

        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">تاكيد كلمة المرور</label>
            <input id="password-confirm" type="password" class="form-control mb-0" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-left">
                تغير كلمة المرور
            </button>
        </div>
    </form>
</div>
@endsection

