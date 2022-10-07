@extends('admin.layout.base')

@section('title', trans('admin.add-memberships'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'memberships.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
    @method('POST')
    @include('admin.memberships.inputs')
    {!! Form::close() !!}
@endsection
