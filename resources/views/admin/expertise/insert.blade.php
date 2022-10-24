@extends('admin.layout.base')

@section('title', trans('admin.add-expertise'))

@section('content')
    {!! Form::open(['method'=>'post' , 'route'=>'expertises.store']) !!}
    @method('POST')
    @include('admin.expertise.inputs')
    {!! Form::close() !!}

@endsection
