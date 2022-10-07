@extends('admin.layout.base')

@section('title', trans('admin.add-settings'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'settings.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.settings.inputs')
    {!! Form::close() !!}
@endsection
