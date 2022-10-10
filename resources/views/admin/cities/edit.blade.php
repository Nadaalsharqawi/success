@extends('admin.layout.base')

@section('title', trans('admin.edit-country'))
@section('style')
<style type="text/css">
	#addRow{
	display: none;
}
</style>


@endsection
@section('content')
    {!! Form::open(['method'=>'put' , 'route'=>['cities.update' , $data->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
        @method('PUT')
        @include('admin.cities.inputs')
    {!! Form::close() !!}
@endsection
