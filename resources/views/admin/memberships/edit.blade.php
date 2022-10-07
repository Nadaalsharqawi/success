@extends('admin.layout.base')

@section('title', trans('admin.edit-memberships'))

@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['memberships.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.memberships.inputs')
    {!! Form::close() !!}
@endsection
