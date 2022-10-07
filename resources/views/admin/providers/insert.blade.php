@extends('admin.layout.base')

@section('title', trans('admin.add-providers'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'providers.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.providers.inputs')
    {!! Form::close() !!}
@endsection
