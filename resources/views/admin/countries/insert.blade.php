@extends('admin.layout.base')

@section('title', trans('admin.add-country'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'countries.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.countries.inputs')
    {!! Form::close() !!}

@endsection
