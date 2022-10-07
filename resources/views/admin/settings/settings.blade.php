@extends('admin.layout.base')

@section('title', trans('admin.settings'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.settings')}}</h4>
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
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>['settings.update'] ,'enctype'=>'multipart/form-data'  , 'id'=>'settings-form']) !!}
                        <div class="row">

                            <div class="form-group col-md-6">
                                {!! Form::label('phone' , trans('admin.phone')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('phone' , old('phone') ?? null  ,['class'=>'form-control' , 'id'=>'phone' , 'placeholder'=>trans('admin.phone')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('whatsapp' , trans('admin.whatsapp')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('whatsapp' , old('whatsapp') ?? null  ,['class'=>'form-control' , 'id'=>'phone' , 'placeholder'=>trans('admin.whatsapp')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('country_id', trans('admin.country')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('country_id', $country, old('country'), [
                                'class' => 'form-control',
                                'id' => 'country_id',
                                'placeholder' => trans('admin.country_id'),
                                ]) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('terms' , trans('admin.terms')) !!}
                                {!! Form::textarea('terms' , old('terms') ?? null  ,['class'=>'form-control' , 'id'=>'terms' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('policy' , trans('admin.policy')) !!}
                                {!! Form::textarea('policy' , old('policy') ?? null  ,['class'=>'form-control' , 'id'=>'policy' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('advertising' , trans('admin.advertising')) !!}
                                {!! Form::textarea('advertising' , old('advertising') ?? null  ,['class'=>'form-control' , 'id'=>'advertising' ,'rows'=>'3']) !!}
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
