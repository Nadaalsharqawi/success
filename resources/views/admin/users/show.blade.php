@extends('admin.layout.base')

@section('title', $data->name)

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    @if(!empty($data->image))
                        <img class="profile-pic img-fluid" src="{{ asset('storage'.$data->image) }}" alt="profile-pic">
                    @else
                        <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                    @endif
                </div>
            </div>

            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="about-info m-0 p-0">
                        <div class="row">
                            @if(!empty($data->name))
                            <div class="col-4">{{trans('admin.name')}}:</div>
                            <div class="col-8">{{$data->name}}</div>
                            @endif
                            @if(!empty($data->phone))
                            <div class="col-5">{{trans('admin.phone')}}:</div>
                            <div class="col-7">{{$data->phone}}</div>
                            @endif
                            @if(!empty($data->email))
                            <div class="col-4">{{trans('admin.email')}}:</div>
                            <div class="col-8">{{$data->email}}</div>
                            @endif
                            @if(!empty($data->gender))
                            <div class="col-4">{{trans('admin.gender')}}:</div>
                            <div class="col-8">{{$data->gender}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
