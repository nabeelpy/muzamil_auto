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

        /*table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable td:last-child, table.table-bordered.dataTable td:last-child {*/
        /*.view{*/
        /*color: #593bdb;*/
        /*}*/


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
                        <p class="mb-1">Issue And Part Return For Jobs List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Issue Part To Jobs</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Issue And Part Return For Jobs List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Issue And Part Return For Jobs List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('issue_parts_to_job.index')}}" method="get">

                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Job #</label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input  type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"
                                                    value="{{$job_no}}">
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <select id="status" name="status">
                                                <option value="0" selected disabled>Select</option>
                                                <option value="Issued">Issued</option>
                                                <option value="Returned">Returned</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Date From</label>
                                        </div>
                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"
                                               value="{{$from_date}}" id="from_date" placeholder="Choose...">
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Date To</label>
                                        </div>
                                        <input type="date" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"
                                               value="{{$to_date}}" id="to_date" placeholder="Choose...">
                                    </div>
                                    <div class="col-1-5">
                                        <div class="form-group" style="margin-bottom: 22px;">
                                            <label for=""></label>
                                        </div>
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>





                                </div>



{{--                                <div class="row">--}}


{{--                                    <div class="col-1-5">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Job#</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="col-1-5">--}}
{{--                                        <label class="float-left" for="">Status</label>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-1-5">--}}
{{--                                        <label class="float-left" for="">Date From</label>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-1-5">--}}
{{--                                        <label class="float-left" for="">Date To</label>--}}
{{--                                    </div>--}}




{{--                                </div>--}}



{{--                                --}}{{--                second--}}
{{--                                <div class="row">--}}

{{--                                    <div class="col-1-5">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <input  type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"--}}
{{--                                                    value="{{$job_no}}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class=" col-1-5">--}}
{{--                                        <select id="status" name="status">--}}
{{--                                            <option value="0" selected disabled>Select</option>--}}
{{--                                                <option value="Issued">Issued</option>--}}
{{--                                                <option value="Returned">Returned</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                    <div class=" col-1-5">--}}
{{--                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"--}}
{{--                                               value="{{$from_date}}" id="from_date" placeholder="Choose...">--}}
{{--                                    </div>--}}



{{--                                    <div class=" col-1-5">--}}
{{--                                        <input type="date" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"--}}
{{--                                               value="{{$to_date}}" id="to_date" placeholder="Choose...">--}}
{{--                                    </div>--}}








{{--                                    <div class="col">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">--}}
{{--                                                Search--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}


                            </form>




                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Job</th>
                                        <th>Technician</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Created At</th>

                                        {{--                                        <th>Created At</th>--}}
                                        {{--                                        <th>Updated At</th>--}}
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

                                            {{--                                            <td>{{$brand->name}}</td>--}}
                                            <td class="view" data-id="{{$brand->iptj_id}}" style="color:#007bff;cursor: pointer">{{$brand->iptj_job_no}}</td>
                                            <td>{{$brand->tech_name}}</td>
                                            <td>{{$brand->iptj_remarks}}</td>

                                            <td >{{$brand->iptj_status}}</td>
                                            <td>{{ date('d-m-Y', strtotime( $brand->iptj_created_at )) }}</td>

                                            {{--                                            <td>{{$brand->par_created_at}}</td>--}}
                                            {{--                                            <td>{{$brand->par_updated_at}}</td>--}}

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


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg mdl_wdth">
            <div class="modal-content base_clr">
                <div class="modal-header">
                    <h4 class="modal-title text-black">Parts Issue Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div id="table_body">

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form_controls">
                            <button type="button" class="btn btn-default form-control cancel_button" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



@endsection
@section('script')

    <script>
        // jQuery("#invoice_no").blur(function () {
        jQuery(".view").click(function () {

            jQuery("#table_body").html("");

            var id = jQuery(this).attr("data-id");

            $('.modal-body').load('{{url("parts_issue_modal_view_details/view/") }}' + '/' + id, function () {
                $('#myModal').modal({show: true});
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            $("#status").select2();

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
