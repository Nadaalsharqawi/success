<div class="row">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">
                    @if (isset($data))
                        {{ trans('admin.edit-settings') }}
                    @else
                        {{ trans('admin.add-settings') }}
                    @endif
                </h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{ trans('admin.settings-info') }}</h4>
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
                            {!! Form::label('phone', trans('admin.phone')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('phone', $data->phone ?? old('phone'), [
                                'class' => 'form-control',
                                'id' => 'phone',
                                'placeholder' => trans('admin.phone'),
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('whatsapp', trans('admin.whatsapp')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('whatsapp', $data->whatsapp ?? old('whatsapp'), [
                                'class' => 'form-control',
                                'id' => 'phone',
                                'placeholder' => trans('admin.whatsapp'),
                            ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('country_id', trans('admin.country')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('country_id[]', $countries, $data->countries ?? old('country'), [
                                'class' => 'form-control',
                                'id' => 'country_id',
                                'multiple',
                                'placeholder' => trans('admin.country_id'),
                            ]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('terms', trans('admin.terms')) !!}
                            {!! Form::textarea('terms', $data->terms ?? old('terms'), ['class' => 'form-control', 'id' => 'terms', 'rows' => '3']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('policy', trans('admin.policy')) !!}
                            {!! Form::textarea('policy', $data->policy ?? old('policy'), [
                                'class' => 'form-control',
                                'id' => 'policy',
                                'rows' => '3',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('advertising', trans('admin.advertising')) !!}
                            {!! Form::textarea('advertising', $data->advertising ?? old('advertising'), [
                                'class' => 'form-control',
                                'id' => 'advertising',
                                'rows' => '3',
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
