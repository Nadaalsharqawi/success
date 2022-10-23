@extends('admin.layout.base')

@section('title', trans('admin.add-product'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'cities.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.products.inputs')
    {!! Form::close() !!}

@endsection
