<div>
    <div class="row">
        <div class="col-md-12">
            <div class="iq-card">
                <a href="{{ route('memberships.create') }}" class="btn btn-text-primary font-weight-bold btn-fixed"
                    data-palcement="top" data-toggle="tooltip" title="{{ trans('admin.add-memberships') }}">
                    <i class="fa fa-plus"></i>
                </a>
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{ trans('admin.memberships') }}
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
                                <th>{{ trans('admin.name_membership') }}</th>
                                <th>{{ trans('admin.service') }}</th>
                                <th>{{ trans('admin.membership_value') }}</th>
                                <th>{{ trans('admin.eligibility_type') }}</th>
                                <th>{{ trans('admin.status') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memberships as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name_membership }}</td>
                                    <td>{{ $item->service->name }}</td>
                                    <td>{{ $item->membership_value }}</td>
                                    <td>{{ $item->eligibility_type }}</td>
                                    @if ($item->off == 0)
                                        <td><button wire:click="off({{ $item->id }})"
                                                class="text-loght btn btn-danger btn-round"
                                                title="Off {{ $item->name }}"> OFF </button></td>
                                    @else
                                        <td><button wire:click="off({{ $item->id }})"
                                                class="text-loght btn btn-success btn-round"
                                                title="On {{ $item->name }}"> ON </button></td>
                                    @endif
                                    <td class="text-center">
                                        <div class="flex align-items-center list-user-action">
                                            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                                title="{{ trans('admin.edit') }}" data-original-title="Edit"
                                                href="{{ route('memberships.edit', $item->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            {{-- <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                        title="{{ trans('admin.discount') }}" data-original-title="Discount"
                                        href="{{ route('memberships.discounts', $item->id) }}">
                                        <i class="ri-pencil-line"></i>
                                    </a> --}}
                                            <a class="iq-bg-primary" href="#" data-toggle="modal"
                                                data-target="#delmodel{{ $item->id }}">
                                                <i class="ri-delete-bin-line" data-toggle="tooltip" data-placement="top"
                                                    title="{{ trans('admin.delete') }}"></i>
                                            </a>
                                            <a class="iq-bg-primary" href="#" data-toggle="modal"
                                                data-target="#desmodel{{ $item->id }}">
                                                <i class="ri-delete-bin-line" data-toggle="tooltip" data-placement="top"
                                                    title="{{ trans('admin.discount') }}"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="delmodel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="delmodellabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="delmodelLabel{{ $item->id }}">
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
                                                            {!! Form::open(['method' => 'delete', 'route' => ['memberships.destroy', $item->id], 'class' => 'd-inline']) !!}
                                                            <button type="submit" class="btn btn-primary border-0"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title=""
                                                                data-original-title="{{ trans('admin.delete') }}">
                                                                {{ trans('admin.delete') }}
                                                            </button>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="desmodel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="desmodellabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="desmodellabel{{ $item->id }}">
                                                                {{ __('admin.discount') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open([
                                                                'method' => 'post',
                                                                'route' => 'memberships.discounts',
                                                                'class' => 'd-inline',
                                                            ]) !!}
                                                            {!! Form::label('value_membership', trans('admin.value_membership')) !!}
                                                            <span class="asters">*</span>
                                                            {!! Form::number('value_membership', $item->membership_value, [
                                                                'class' => 'form-control',
                                                                'id' => 'value_membership',
                                                                'disabled',
                                                                'placeholder' => trans('admin.value_membership'),
                                                            ]) !!}
                                                            {!! Form::label('discount', trans('admin.discount')) !!}
                                                            <span class="asters">*</span>
                                                            {!! Form::number('discount', null, [
                                                                'class' => 'form-control',
                                                                'id' => 'discount',
                                                                'step' => '0.1',
                                                                'placeholder' => trans('admin.discount'),
                                                            ]) !!}
                                                            {!! Form::label('start_date', trans('admin.start_date')) !!}
                                                            <span class="asters">*</span>
                                                            {!! Form::date('start_date', null, [
                                                                'class' => 'form-control',
                                                                'id' => 'start_date',
                                                                'step' => '0.1',
                                                                'placeholder' => trans('admin.start_date'),
                                                            ]) !!}
                                                            {!! Form::label('end_date', trans('admin.end_date')) !!}
                                                            <span class="asters">*</span>
                                                            {!! Form::date('end_date', null, [
                                                                'class' => 'form-control',
                                                                'id' => 'end_date',
                                                                'step' => '0.1',
                                                                'placeholder' => trans('admin.end_date'),
                                                            ]) !!}
                                                            {!! Form::hidden('membership_id', $item->id) !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            @method('POST')
                                                            {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary ml-2 pull-left']) !!}
                                                            {!! Form::reset(trans('admin.cancel'), ['class' => 'btn btn-secondary pull-left']) !!}
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
</div>
