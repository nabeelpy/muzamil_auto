@extends('layouts.theme_list')

@section('content')



    <style>

        .col-1-5 {
            flex: 0 0 12.6%;
            max-width: 12.6%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }


    </style>




    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Client List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Client</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Client List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Client List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('edit_client.index')}}" method="get">

                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for="">Search</label>
                                        </div>
                                    </div>

                                </div>



                                {{--                second--}}
                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <input  type="text" tabindex="1" id="search" name="search" class="form-control form-control-sm"
                                                    value="{{$search}}">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">



                                </div>



                            </form>




                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $segmentSr  = (!empty(app('request')->input('segmentSr'))) ? app('request')->input('segmentSr') : '';
                                        $segmentPg  = (!empty(app('request')->input('page'))) ? app('request')->input('page') : '';
                                        $sr = (!empty($segmentSr)) ? $segmentSr * $segmentPg - $segmentSr + 1 : 1;
                                        $countSeg = (!empty($segmentSr)) ? $segmentSr : 0;
                                        $prchsPrc = $slePrc = $avrgPrc = 0;
                                    @endphp



                                    @foreach($query as $brand)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td>{{$brand->cli_name}}</td>
                                            <td>{{$brand->cli_number}}</td>
                                            <td>{{$brand->cli_address}}</td>
                                            <td><a href="{{route('edit_client.edit',$brand->cli_id)}}"><i class="fas fa-edit"></i></a></td>

                                        </tr>

                                        @php
                                            $sr++; (!empty($segmentSr) && $countSeg !== '0') ?  : $countSeg++;
                                        @endphp
                                    @endforeach


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('script')


    <script>
        $(document).ready(function () {

            // $('#form').validate({ // initialize the plugin
            //
            //     rules: {
            //         brand: {
            //             required: true,
            //
            //         }
            //     },
            //     messages: {
            //         brand: {
            //             required: "Required"
            //         }
            //
            //     },
            //
            //     ignore: [],
            //     errorClass: "invalid-feedback animated fadeInUp",
            //     errorElement: "div",
            //     errorPlacement: function (e, a) {
            //         jQuery(a).parents(".form-group > div").append(e)
            //     },
            //     highlight: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            //     },
            //     success: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            //     },
            //
            // });

        });
    </script>
@stop
