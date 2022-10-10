@extends('admin.layout.base')

@section('title', trans('admin.add-city'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'cities.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.cities.inputs')
    {!! Form::close() !!}

@endsection
