@extends('admin.layout.base')

@section('title', trans('admin.edit-user'))

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.edit-user')}} </h4>
                    </div>
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-body">
                    <form>
                        <div class="form-group text-center">
                            <div class="add-img-user profile-img-edit">
                                @if(!empty($data->image))
                                    <img class="profile-pic img-fluid" src="{{ asset('storage/'.$data->image) }}" alt="profile-pic">
                                @else
                                    <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                                @endif
                                <div class="p-image">
                                    <a href="#" class="upload-button btn iq-bg-primary">{{trans('admin.image')}}</a>
                                    <input name="image" class="file-upload" form="edit-user-form" type="file" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.user-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'put' , 'route'=>['users.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
                        <div class="row">
                            @method('PUT')
                            <div class="form-group col-md-6">
                                {!! Form::label('name' , trans('admin.name')) !!}
                                <span class="asters">*</span>
                                {!! Form::hidden('type' , 'admin') !!}
                                {!! Form::hidden('id' , $data->id) !!}
                                {!! Form::text('name' , old('name') ?? $data->name ,['class'=>'form-control' ,'required'=>'required', 'id'=>'name' , 'placeholder'=>trans('admin.name')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('email', trans('admin.email')) !!}
                                <span class="asters">*</span>
                                {!! Form::email('email', $data->email ?? old('email'), [
                                'class' => 'form-control',
                                'required' => 'required',
                                'id' => 'email',
                                'placeholder' => trans('admin.email'),
                                ]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('phone' , trans('admin.phone')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('phone' , old('phone') ?? $data->phone ,['class'=>'form-control' ,'required'=>'required', 'id'=>'phone' , 'placeholder'=>trans('admin.phone')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('type' , trans('admin.type')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('type' ,['admin'=>"admin",'provider'=>"provider"] ,$data->type ?? old('type') ,['class'=>'form-control' , 'id'=>'type' , 'placeholder'=>trans('admin.type')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('country', trans('admin.country')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('country', $country, old('country'), [
                                'class' => 'form-control',
                                'id' => 'country',
                                'placeholder' => trans('admin.country'),
                                ]) !!}
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
