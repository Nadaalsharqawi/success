@extends('admin.layout.base')

@section('title', trans('admin.edit-service'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['services.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.services.inputs')
    {!! Form::close() !!}
@endsection
