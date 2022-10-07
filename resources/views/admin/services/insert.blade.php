@extends('admin.layout.base')

@section('title', trans('admin.add-service'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'services.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.services.inputs')
    {!! Form::close() !!}

@endsection
