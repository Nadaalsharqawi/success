@extends('admin.layout.base')

@section('title', trans('admin.add-ads'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'ads-Setting.store'  , 'id'=>'add-user-form']) !!}
    @method('POST')
  @include('admin.adsSetting.inputs')
    {!! Form::close() !!}
@endsection
