@extends('admin.layout.base')

@section('title', trans('admin.add-ads'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'ads.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.ads.inputs')
    {!! Form::close() !!}
@endsection
