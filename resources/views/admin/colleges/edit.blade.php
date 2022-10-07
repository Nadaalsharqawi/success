@extends('admin.layout.base')

@section('title', trans('admin.edit-colleges'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['colleges.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.colleges.inputs')
    {!! Form::close() !!}
@endsection
