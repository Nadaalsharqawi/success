@extends('admin.layout.base')

@section('title', trans('admin.add-university'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'universities.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.university.inputs')
    {!! Form::close() !!}

@endsection
