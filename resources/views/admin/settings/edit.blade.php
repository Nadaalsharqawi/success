@extends('admin.layout.base')

@section('title', trans('admin.edit-settings'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['settings.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.settings.inputs')
    {!! Form::close() !!}
@endsection
