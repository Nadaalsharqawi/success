@extends('admin.layout.base')
@section('title', trans('admin.products'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="iq-card">
            
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">
                    {{ trans('admin.products') }}
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
                    <th>{{ trans('admin.expertise') }}</th>
                    <th>{{ trans('admin.status') }}</th>
                    <th>{{ trans('admin.image') }}</th>
                    <th>{{ trans('admin.pages_number') }}</th>
                    <th>{{ trans('admin.description') }}</th>
                    <th>{{ trans('admin.price') }}</th>
                    <th>{{ trans('admin.university') }}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->expertise->name }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                     @if ($item->image != null)
                     <img src="{{ Storage::url('/'.$item->image) }}"
                     style="width:40px;height:40px;" />
                     @else
                     <img src="{{ asset('assets/imgs/avatar.png') }}"
                     style="width:40px;height:40px;" />
                     @endif
                 </td>
                 <td>{{ $item->pages_number }}</td>
                 <td>{{ $item->description }}</td>
                 <td>{{ $item->price }}</td>
                 <td>{{ $item->university }}</td>


             </tr>
             @endforeach
         </tbody>
     </table>
 </div>
</div>
</div>
</div>
@endsection
