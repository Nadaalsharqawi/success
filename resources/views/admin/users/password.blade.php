@extends('admin.layout.base')

@section('title', trans('admin.password'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.update_password')}} </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if(session()->has('success'))
                        <div class="alert text-white bg-primary" role="alert">
                            <div class="iq-alert-text">{{session()->get('success')}}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('failed'))
                    <div class="alert text-white bg-danger" role="alert">
                        <div class="iq-alert-text">{{session()->get('failed')}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'update.password.post' ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('old-password' , trans('admin.old-password')) !!}
                                <span class="asters">*</span>
                                {!! Form::password('old_password' ,['class'=>'form-control', 'id'=>'old-password' , 'autocomplete'=>'new-password' ,  'placeholder'=>trans('admin.old-password')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('password' , trans('admin.password')) !!}
                                <span class="asters">*</span>
                                {!! Form::password('password' ,['class'=>'form-control', 'id'=>'password' , 'autocomplete'=>'new-password' ,  'placeholder'=>trans('admin.password')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('con-password' , trans('admin.con-password')) !!}
                                <span class="asters">*</span>
                                {!! Form::password('password_confirmation' ,['class'=>'form-control' , 'id'=>'con-password' ,'autocomplete'=>'new-password', 'placeholder'=>trans('admin.con-password')]) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::submit(trans('admin.save') , ['class'=>'btn btn-primary ml-2 pull-left']) !!}
                                {!! Form::reset(trans('admin.cancel') , ['class'=>'btn btn-secondary pull-left']) !!}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
