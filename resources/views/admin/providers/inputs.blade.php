<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if (isset($data))
                            {{ trans('admin.edit-providers') }}
                        @else
                            {{ trans('admin.add-providers') }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <form>
                    <div class="form-group text-center">
                        <div class="add-img-user profile-img-edit">
                            @if (isset($data) && $data->image != null)
                                <img class="profile-pic img-fluid" src="{{ asset('storage/' . $data->image) }}"
                                    alt="profile-pic">
                            @else
                                <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}"
                                    alt="profile-pic">
                            @endif
                            <div class="p-image">
                                <a href="#" class="upload-button btn iq-bg-primary">{{ trans('admin.image') }}</a>
                                <input name="image" class="file-upload" type="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{ trans('admin.ads-info') }}</h4>
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
                            {!! Form::select('service_id[]', $services, $data->services ?? old('service_id'), [
                                'class' => 'form-control',
                                'id' => 'service_id',
                                'multiple',
                                'placeholder' => trans('admin.services'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('name_place', trans('admin.name_place')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('name_place', $data->name_place ?? old('name_place'), [
                                'class' => 'form-control',
                                'id' => 'name_place',
                                'placeholder' => trans('admin.name_place'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('location', trans('admin.location')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('location', $data->location ?? old('location'), [
                                'class' => 'form-control',
                                'id' => 'location',
                                'placeholder' => trans('admin.location'),
                            ]) !!}
                        </div>
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
                            {!! Form::label('show_phone', trans('admin.show_phone')) !!}
                            <span class="asters">*</span>
                            {!! Form::select(
                                'show_phone',
                                [
                                    '1' => trans('admin.yes'),
                                    '0' => trans('admin.no'),
                                ],
                                $data->show_phone ?? old('show_phone'),
                                ['class' => 'form-control', 'id' => 'show_phone', 'placeholder' => trans('admin.show_phone')],
                            ) !!}
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
                            {!! Form::label('show_whatsapp', trans('admin.show_whatsapp')) !!}
                            <span class="asters">*</span>
                            {!! Form::select(
                                'show_whatsapp',
                                [
                                    '1' => trans('admin.yes'),
                                    '0' => trans('admin.no'),
                                ],
                                $data->show_whatsapp ?? old('show_whatsapp'),
                                ['class' => 'form-control', 'id' => 'show_whatsapp', 'placeholder' => trans('admin.show_whatsapp')],
                            ) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('fac', trans('admin.fac')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('fac', $data->fac ?? old('fac'), [
                                'class' => 'form-control',
                                'id' => 'fac',
                                'placeholder' => trans('admin.fac'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('ins', trans('admin.ins')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('ins', $data->ins ?? old('ins'), [
                                'class' => 'form-control',
                                'id' => 'ins',
                                'placeholder' => trans('admin.ins'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('snap', trans('admin.snap')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('snap', $data->snap ?? old('snap'), [
                                'class' => 'form-control',
                                'id' => 'snap',
                                'placeholder' => trans('admin.snap'),
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
