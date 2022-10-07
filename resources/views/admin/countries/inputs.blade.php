<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if(isset($data))
                        {{trans('admin.edit-country')}}
                        @else
                        {{trans('admin.add-country')}}
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
                            @if(isset($data) && $data->logo != null)
                            <img class="profile-pic img-fluid" src="{{ asset('storage/'.$data->logo) }}" alt="profile-pic">
                            @else
                            <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                            @endif
                            <div class="p-image">
                                <a href="#" class="upload-button btn iq-bg-primary">{{trans('admin.image')}}</a>
                                <input name="logo" class="file-upload"  form="add-user-form" type="file" accept="image/*">
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
                    <h4 class="card-title"> {{trans('admin.country-info')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                @include('admin.include.messages_errors')
                <div class="new-user-info">
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('name_ar' , trans('admin.name_ar')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('name_ar' , $data->name_ar ?? old('name_ar') ,['class'=>'form-control' , 'id'=>'name_ar' , 'placeholder'=>trans('admin.name_ar')]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('name_en' , trans('admin.name_en')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('name_en' , $data->name_en ?? old('name_en') ,['class'=>'form-control' , 'id'=>'name_en' , 'placeholder'=>trans('admin.name_en')]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('country_code' , trans('admin.country_code')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('short_code' , $data->short_code ?? old('short_code') ,['class'=>'form-control' , 'id'=>'country_code' , 'placeholder'=>trans('admin.country_code')]) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit(trans('admin.save') , ['class'=>'btn btn-primary ml-2 pull-left']) !!}
                            {!! Form::reset(trans('admin.cancel') , ['class'=>'btn btn-secondary pull-left']) !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
