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
                        <p class="mb-1">Sale Invoice For Jobs List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Cash Invoices</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sale Invoice For Jobs</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sale Invoice For Jobs List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sale Invoice For Jobs List</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button >--}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('sale_invoice_for_jobs.index')}}" method="get">

                                <div class="row">

                                    <div class="col-1">
                                        <div class="form-group mb-0 float-right">
                                            <label for="">Search</label>
                                        </div>
                                    </div>



                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Date</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                </div>



                                {{--                second--}}
                                <div class="row">



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Invoice#</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input type="text" tabindex="2" onkeypress='validate(event)' name="invoice" class="form-control form-control-sm" id="invoice">
                                    </div>





                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">From</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"
                                               value="{{$from_date}}" id="from_date" placeholder="Choose...">

                                    </div>


                                </div>


                                <div class="row">



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Job#</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input onkeypress='validate(event)' tabindex="3" type="text" name="job" class="form-control form-control-sm" id="job">
                                    </div>




                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">To</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input type="date" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"
                                               value="{{$to_date}}" id="to_date" placeholder="Choose...">
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Invoice#</th>
                                        <th>Job No</th>
                                        <th>Cash Account</th>
                                        <th>Job Cost</th>
                                        <th>Amount Pay</th>
                                        <th>Discount</th>
                                        <th>Remaining Cost</th>
                                        <th>Remarks</th>
                                        <th>Date</th>
                                        {{--                                        <th>Created At</th>--}}
{{--                                        <th>Actions</th>--}}
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
                                    @foreach($query as $sale_invoice_for_jobs)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td class="view" data-id="{{$sale_invoice_for_jobs->sifj_id}}" style="color:#007bff;cursor: pointer">{{$sale_invoice_for_jobs->sifj_id}}</td>
                                            <td >{{$sale_invoice_for_jobs->sifj_job_no}}</td>
                                            <td>{{$sale_invoice_for_jobs->ca_name}}</td>
                                            <td>{{$sale_invoice_for_jobs->sifj_real_estimated_cost}}</td>
                                            <td>{{$sale_invoice_for_jobs->sifj_amount_paid}}</td>
                                            <td>{{$sale_invoice_for_jobs->sifj_discount}}</td>

                                            <td>{{$sale_invoice_for_jobs->sifj_remaining_cost}}</td>
                                            <td>{{$sale_invoice_for_jobs->sifj_remarks}}</td>
                                            <td>{{ date('d-m-Y', strtotime( $sale_invoice_for_jobs->sifj_created_at )) }}</td>
                                            {{--                                            <td>{{$sale_invoice_for_jobs->sifj_updated_at}}</td>--}}
{{--                                            <td><a href="{{route('sale_invoice_for_jobs.edit',$sale_invoice_for_jobs->sifj_id)}}"><button type="button"  class="btn btn-primary" >Edit</button></a></td>--}}

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
                    <h4 class="modal-title text-black">Sales Invoice For Jobs Detail</h4>
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

            $('.modal-body').load('{{url("sale_job_invoice_modal_view_details/view/") }}' + '/' + id, function () {
                $('#myModal').modal({show: true});
            });

        });
    </script>









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
