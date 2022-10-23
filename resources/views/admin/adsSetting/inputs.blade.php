 <div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if (isset($data))
                            {{ trans('admin.edit-ads') }}
                        @else
                            {{ trans('admin.add-ads') }}
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
                            {!! Form::select('country_id[]', $countries, $data->countries?? old('country_id'), [
                                'class' => 'form-control',
                                'id' => 'country_id',
                                'multiple',
                                'placeholder' => trans('admin.country'),
                            ]) !!}
                        </div>
                         <div class="form-group col-md-6">
                            {!! Form::label('service_id', trans('admin.services')) !!}
                            <span class="asters">*</span>

                            <select name='duration_status'  class ='form-control' id ='duration_status' placeholder = 's' >
                            <option value="فتره الاعلان">فتره الاعلان</option>
                            <option value="وقت الاعلان">وقت الاعلان</option>
                            </select>


                            {{-- <input type="range" min="0" max="11" value="7" step="1" /> --}}
                            
                            {{-- {!! Form::select('service_id', $services, $data->services ?? old('service_id'), [
                                'class' => 'form-control',
                                'id' => 'service_id',
                                'placeholder' => trans('admin.services'),
                            ]) !!} --}}

                            
                            
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('date_publication' , trans('admin.date_publication')) !!}
                            <span class="asters">*</span>
                            {!! Form::date('date_publication' ,$data->date_publication ?? old('date_publication') ,['class'=>'form-control' , 'id'=>'date_publication' , 'placeholder'=>trans('admin.date_publication')]) !!}
                        </div>
                        {{-- <div class="form-group col-md-6">
                            {!! Form::label('date_expiry' , trans('admin.date_expiry')) !!}
                            <span class="asters">*</span>
                            {!! Form::date('date_expiry' ,$data->date_expiry ?? old('date_expiry') ,['class'=>'form-control' , 'id'=>'date_expiry' , 'placeholder'=>trans('admin.date_expiry')]) !!}
                        </div> --}}
                        {{-- <div class="form-group col-md-12">
                            {!! Form::label('body', trans('admin.body')) !!}
                            <span class="asters">*</span>
                            {!! Form::textarea('body', $data->body ?? old('body'), [
                                'class' => 'form-control',
                                'id' => 'body',
                                'rows' => '3',
                                'placeholder' => trans('admin.body'),
                            ]) !!}
                        </div> --}}
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