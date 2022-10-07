
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta char set="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{trans('admin.app-name')}} |  {{trans('admin.privacy')}} </title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/logos/logo_small.svg')}}" />

        <!-- ====================================== start css vito files ========================== -->
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/bootstrap.min.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/typography.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/style.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/responsive.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/custom-lang.css?v=7.0.3')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="iq-card mt-4">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">
                                {{trans('admin.terms')}}
                            </h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        {{$data}}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
