@extends('auth.auth_layout')
@section('title' , 'verify')
@section('content')
<div class="sign-in-from">
    <h5 class="mb-0 sendingingMessage2">تم ارسال كود الي رقم الجوال {{$phone}}</h5>
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
    <div class="alert text-white bg-primary sendingingMessage d-none" role="alert">
        <div class="iq-alert-text">

        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        x
        </button>
    </div>
    <form class="mt-4" method="POST" action="{{ route('admin.verify.account') }}">
        @csrf
        <div class="form-group">
            <label for="code">الكود</label>
            <input type="number" class="form-control mb-0" id="code" placeholder="من فضل ادخل الكود الذي تم ارساله الي رقم جوالك" name="code" value="{{ old('code') }}" required autocomplete="off" autofocus>
            @error('code')
                <strong>{{ $message }}</strong>
            @enderror
            <br/>
            <a class="btn btn-link" id="send-code">
                ارسال مرة اخري ؟
            </a>
        </div>
        <div class="d-inline-block w-100">
            <button type="submit" class="btn btn-primary float-right">تاكيد</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script>
        $('#send-code').click(function() {
            console.log('kk');
            $.ajax({
                url: "{{ route('admin.verify.sendCode') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data, status, jqXHR) {
                    console.log(data, status, jqXHR);
                    if(status == 'success'){
                        $('.sendingingMessage').removeClass('d-none');
                        $('.sendingingMessage2').addClass('d-none');
                        $('.sendingingMessage .iq-alert-text').text(data.message);
                    }

                }
            });
            return false;
        });

    </script>
@endsection



