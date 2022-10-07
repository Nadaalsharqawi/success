@extends('admin.layout.base')
@section('title', trans('admin.countries'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="iq-card">
                <a href="{{ route('countries.create') }}" class="btn btn-text-primary font-weight-bold btn-fixed"
                    data-palcement="top" data-toggle="tooltip" title="{{ trans('admin.add-country') }}">
                    <i class="fa fa-plus"></i>
                </a>
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{ trans('admin.countries') }}
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if (session()->has('success'))
                        <div class="alert text-white bg-primary" role="alert">
                            <div class="iq-alert-text">{{ session()->get('success') }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example"
                        id="kt_datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.country_code') }}</th>
                                <th>{{ trans('admin.logo') }}</th>
                                <th>{{ trans('admin.status') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->short_code }}</td>
                                    <td>
                                        @if ($item->logo != null)
                                            <img src="{{ asset('storage/' . $item->logo) }}"
                                                style="width:40px;height:40px;" />
                                        @else
                                            <img src="{{ asset('assets/imgs/avatar.png') }}"
                                                style="width:40px;height:40px;" />
                                        @endif
                                    </td>
                                    @if ($item->status == 1)
                                        {{-- <td><button wire:click="status({{ $item->id }})"
                                                class="text-loght btn btn-danger btn-round"
                                                title="Active {{ $item->name }}"> InActive </button></td> --}}
                                        <td><button class="text-loght btn btn-danger btn-round"
                                                title="Active {{ $item->name }}"> InActive </button></td>
                                    @else
                                        {{-- <td><button wire:click="status({{ $item->id }})"
                                                class="text-loght btn btn-success btn-round"
                                                title="InActive {{ $item->name }}"> Active </button></td> --}}
                                        <td><button class="text-loght btn btn-success btn-round"
                                                title="InActive {{ $item->name }}"> Active </button></td>
                                    @endif
                                    <td class="text-center">
                                        <div class="flex align-items-center list-user-action">
                                            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                                title="{{ trans('admin.edit') }}" data-original-title="Edit"
                                                href="{{ route('countries.edit', $item->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a class="iq-bg-primary" href="#" data-toggle="modal"
                                                data-target="#delmodel{{ $item->id }}">
                                                <i class="ri-delete-bin-line" data-toggle="tooltip" data-placement="top"
                                                    title="{{ trans('admin.delete') }}"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="delmodel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="delmodellabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delmodelLabel{{ $item->id }}">
                                                                {{ __('admin.delete') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-left">
                                                                {{ __('admin.are-you-sure-to delete') }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('admin.cancel') }}</button>
                                                            {!! Form::open(['method' => 'delete', 'route' => ['countries.destroy', $item->id], 'class' => 'd-inline']) !!}
                                                            <button type="submit" class="btn btn-primary border-0"
                                                                data-toggle="tooltip" data-placement="top" title=""
                                                                data-original-title="{{ trans('admin.delete') }}">
                                                                {{ trans('admin.delete') }}
                                                            </button>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
