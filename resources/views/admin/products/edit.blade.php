@extends('admin.layout.base')

@section('title', trans('admin.edit-product'))
@section('style')



@endsection
@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['products.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.products.inputs')
    {!! Form::close() !!}
@endsection
