<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if (isset($data))
                            {{ trans('admin.edit-memberships') }}
                        @else
                            {{ trans('admin.add-memberships') }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{ trans('admin.memberships-info') }}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                @if (session()->has('failed'))
                    <div class="alert text-white bg-primary" role="alert">
                        <div class="iq-alert-text">{{ session()->get('failed') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                @include('admin.include.messages_errors')
                <div class="new-user-info">
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('name_membership', trans('admin.name_membership')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('name_membership', $data->name_membership ?? old('name_membership'), [
                                'class' => 'form-control',
                                'id' => 'name_membership',
                                'placeholder' => trans('admin.name_membership'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('membership_value', trans('admin.membership_value')) !!}
                            <span class="asters">*</span>
                            {!! Form::number('membership_value', $data->membership_value ?? old('membership_value'), [
                                'class' => 'form-control',
                                'id' => 'membership_value',
                                'step' => '0.1',
                                'placeholder' => trans('admin.membership_value'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('eligibility_type', trans('admin.eligibility_type')) !!}
                            <span class="asters">*</span>
                            {!! Form::select(
                                'eligibility_type',
                                [
                                    'month' => trans('admin.month'),
                                    'three_months' => trans('admin.three_months'),
                                    'six_months' => trans('admin.six_months'),
                                    'year' => trans('admin.year'),
                                ],
                                $data->eligibility_type ?? old('eligibility_type'),
                                ['class' => 'form-control', 'id' => 'eligibility_type', 'placeholder' => trans('admin.eligibility_type')],
                            ) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('country_id', trans('admin.country')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('country_id[]', $countries, $data->countries ?? old('country_id'), [
                                'class' => 'form-control',
                                'id' => 'country_id',
                                'multiple',
                                'placeholder' => trans('admin.country'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('service_id', trans('admin.services')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('service_id', $services, $data->service ?? old('service_id'), [
                                'class' => 'form-control',
                                'id' => 'service_id',
                                'placeholder' => trans('admin.services'),
                            ]) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit(trans('admin.save'), ['class' => 'btn btn-primary ml-2 pull-left']) !!}
                            {!! Form::reset(trans('admin.cancel'), ['class' => 'btn btn-secondary pull-left']) !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
