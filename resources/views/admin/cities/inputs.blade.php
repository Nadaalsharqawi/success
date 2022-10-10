<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        @if(isset($data))
                        {{trans('admin.edit-citty')}}
                        @else
                        {{trans('admin.add-city')}}
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
                    <h4 class="card-title"> {{trans('admin.city-info')}}</h4>
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
                            {!! Form::label('country_id', trans('admin.country')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('country_id', $country , $data->country ?? old('country_id'), [
                            'class' => 'form-control',
                            'id' => 'country_id',
                            'placeholder' => trans('admin.country'),
                            ]) !!}
                        </div>

                         <div class="col-md-12">
                            <button id="addRow" type="button" class="btn btn-info">+</button> 
                        </div>
                       <!--  <div id="newRow" class="row"></div> -->
                         
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
