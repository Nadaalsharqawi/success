@extends('admin.layout.base')
@section('title', trans('admin.settings'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="iq-card">
                <a href="{{ route('settings.create') }}" class="btn btn-text-primary font-weight-bold btn-fixed"
                    data-palcement="top" data-toggle="tooltip" title="{{ trans('admin.add-settings') }}">
                    <i class="fa fa-plus"></i>
                </a>
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{ trans('admin.settings') }}
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
                                <th>{{ trans('admin.phone') }}</th>
                                <th>{{ trans('admin.whatsapp') }}</th>
                                <th>{{ trans('admin.terms') }}</th>
                                <th>{{ trans('admin.policy') }}</th>
                                <th>{{ trans('admin.advertising') }}</th>
                                <th>{{ trans('admin.country') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->whatsapp }}</td>
                                    <td>{{ $item->terms }}</td>
                                    <td>{{ $item->policy }}</td>
                                    <td>{{ $item->advertising }}</td>
                                    <td>
                                        @foreach ($item->countries as $country)
                                            <li>{{ $country->name }}</li>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="flex align-items-center list-user-action">
                                            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                                title="{{ trans('admin.edit') }}" data-original-title="Edit"
                                                href="{{ route('settings.edit', $item->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
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
