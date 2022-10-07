<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if (isset($data))
                            {{ trans('admin.edit-service') }}
                        @else
                            {{ trans('admin.add-service') }}
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
                            @if (isset($data) && $data->logo != null)
                                <img class="profile-pic img-fluid" src="{{ asset('storage/' . $data->logo) }}"
                                    alt="profile-pic">
                            @else
                                <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}"
                                    alt="profile-pic">
                            @endif
                            <div class="p-image">
                                <a href="#" class="upload-button btn iq-bg-primary">{{ trans('admin.logo') }}</a>
                                <input name="logo" class="file-upload" type="file" accept="logo/*">
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
                    <h4 class="card-title"> {{ trans('admin.service-info') }}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                @include('admin.include.messages_errors')
                <div class="new-user-info">
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('name', trans('admin.name')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('name', $data->name ?? old('name'), [
                                'class' => 'form-control',
                                'id' => 'name',
                                'placeholder' => trans('admin.name'),
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('country_id', trans('admin.country')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('country_id[]', $country, $data->countries ?? old('country_id'), [
                                'class' => 'form-control',
                                'id' => 'country_id',
                                'multiple',
                                'placeholder' => trans('admin.country'),
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