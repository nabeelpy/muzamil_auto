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
                        <p class="mb-1">Job Close Reason List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Close Reason</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Job Close Reason List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Job Close Reason List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Job Close Reason</th>
{{--                                        <th>User Name</th>--}}
                                        <th>Date</th>
{{--                                        <th>Updated At</th>--}}
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
                                            <td>{{$brand->jcr_name}}</td>
{{--                                            <td>{{$brand->name}}</td>--}}
                                            <td>{{ date('d-m-Y', strtotime( $brand->jcr_created_at )) }}</td>
{{--                                            <td>{{$brand->jcr_updated_at}}</td>--}}
                                            <td><a href="{{route('job_close_reason.edit',$brand->jcr_id)}}"><i class="fas fa-edit"></i></a></td>

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
            $('#form').validate({ // initialize the plugin

                rules: {
                    brand: {
                        required: true,

                    }
                },
                messages: {
                    brand: {
                        required: "Required"
                    }

                },

                ignore: [],
                errorClass: "invalid-feedback animated fadeInUp",
                errorElement: "div",
                errorPlacement: function (e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },

            });

        });
    </script>
@stop
