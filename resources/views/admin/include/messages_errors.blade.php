@if($errors->any())
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="alert-2 alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <li class="p-2">{{trans("admin.$error")}}</li>
                @endforeach
            </div>
        </div>
    </div>
@endif


