@extends('admin.layout.base')

@section('title', trans('admin.add-college'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'colleges.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.colleges.inputs')
    {!! Form::close() !!}

@endsection
