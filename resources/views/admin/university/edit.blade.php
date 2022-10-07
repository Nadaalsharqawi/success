@extends('admin.layout.base')

@section('title', trans('admin.edit-country'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['universities.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.university.inputs')
    {!! Form::close() !!}
@endsection
