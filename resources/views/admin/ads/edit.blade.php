@extends('admin.layout.base')

@section('title', trans('admin.edit-providers'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['providers.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.providers.inputs')
    {!! Form::close() !!}
@endsection
