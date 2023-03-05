<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Job Server') }}</title>--}}
    <title>Job Server</title>
    <!-- start theme links  -->


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('theme/images/RFlogo.png')}}">
    <link href="{{asset('theme/vendor/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">--}}

    <link rel="stylesheet" href="{{asset('theme/vendor/select2/css/select2.min.css')}}">
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/style2.css')}}" rel="stylesheet">
    <!-- end theme links  -->

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Datatable -->
    <link href="{{asset('theme/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('theme/css/style.css" rel="stylesheet')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Ibrahim add -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <style>
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px !important;
        }
        table.dataTable>thead .sorting_asc{
            width: ;
        }
        td,th{
            /*white-space: nowrap;*/
        }
        tr{
            line-height: 1rem;
        }
        .table-responsive{
            overflow-x: inherit !important;
        }
        .card{
            width: fit-content;
            min-width: 100% !important;
        }
        #main-wrapper{
            overflow: unset;
        }
        body{
            overflow: scroll;
            font-size: 0.8rem !important;
        }
        .srch_box_opn_icon{
            flex: auto;
            margin-left: 12px;
        }
        .footer{
            height: 8vh;
        }
        .content-body{
            min-height: 89vh !important;
        }
        .table{
            padding: 0px !important;
        }
        .icon-hide{

        }
        thead{
            background-color: white;
        }
        th {
            position: sticky !important;
            top: 76px;
            box-shadow: 0 2px 2px -1px rgb(0 0 0 / 40%);
            background-color: white !important;
        }
        thead{
            /*position: absolute;*/
        }
    </style>
</head>
<body>
<div id="app">
    <!--*******************
       Preloader start
   ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
            <div class="sk-child sk-bounce4"></div>
            <div class="sk-child sk-bounce5"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div id="main-wrapper">
        @include('inc.theme._navbar')
        @include('inc.theme._sidebar')
    {{--        <div class="main-content">--}}
    <!-- ibrahim change -->
        <main class="py-4">
{{--        <main>--}}
            @yield('content')
        </main>
        @include('inc._footer')
        {{--    </div>--}}
    </div>
</div>



<!-- Required vendors -->
<script src="{{asset('theme/vendor/global/global.min.js')}}"></script>
<script src="{{asset('theme/js/quixnav-init.js')}}"></script>
<script src="{{asset('theme/js/custom.min.js')}}"></script>

<script src="{{asset('theme/vendor/chartist/js/chartist.min.js')}}"></script>

<script src="{{asset('theme/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('theme/vendor/pg-calendar/js/pignose.calendar.min.js')}}"></script>


<script src="{{asset('theme/js/dashboard/dashboard-2.js')}}"></script>
<!-- Circle progress -->

<!-- Required vendors -->
{{--<script src="{{asset('theme/vendor/global/global.min.js')}}"></script>--}}
<script src="{{asset('theme/js/quixnav-init.js')}}"></script>



@yield('script')

<script src="{{asset('theme/js/custom.min.js')}}"></script>


<!-- Jquery Validation -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

<script src="{{asset('theme/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('theme/js/plugins-init/select2-init.js')}}"></script>

<!-- Datatable -->
{{-- <script src="{{asset('theme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('theme/js/plugins-init/datatables.init.js')}}"></script>--}}

<!-- Ibrahim add -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
    $('#example').DataTable();
</script>

<!-- select links -->


<script src="{{asset('theme/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('theme/js/plugins-init/select2-init.js')}}"></script>
{{--<script src="{{asset('plugins/float_head/jquery.floatThead.min.js')}}"></script>--}}
{{--<script src="https://jadeedmunshi.com/pos/public/plugins/nabeel_blue/jquery.floatThead.js"></script>--}}

<!-- Ibrahim add -->

<script>
    // $('table').floatThead({
    //     position:'absolute'
    // });
    var element = document.getElementById("example_filter");
    element.style.display = "block";
    var element2 = document.getElementById("example_length");
    element2.style.display = "block";
    function hide_the_search(){
        // alert("called");
        var x = document.getElementById("example_filter");
        var y = document.getElementById("example_length");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "block";
        } else {
            x.style.display = "none";
            y.style.display = "none";
        }
    }
</script>


</body>
</html>
