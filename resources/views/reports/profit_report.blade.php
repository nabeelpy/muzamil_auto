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
                        <p class="mb-1">Profit Report</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Report</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Profit Report</a></li>

                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profit Report</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button >--}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('Profit_Report')}}" method="get">

                                <div class="row">

                                    {{--                                    <div class="col-1-5">--}}
                                    {{--                                        <div class="form-group mb-0">--}}
                                    {{--                                            <label for="">Job Number</label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}



                                    {{--                                    <div class="col-1-5">--}}
                                    {{--                                        <div class="form-group mb-0">--}}
                                    {{--                                            <label class="float-left mt-2" for="">Status</label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}


                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Search</label>
                                        </div>
                                    </div>

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <label for=""></label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for=""></label>
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

                                    {{--                                    <div class="col-1-5">--}}
                                    {{--                                        <div class="form-group mb-0">--}}
                                    {{--                                            <input  type="text" tabindex="1" id="search" name="search" class="form-control form-control-sm"--}}
                                    {{--                                                    value="{{$search}}">--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}



                                    {{--                                    <div class=" col-1-5">--}}
                                    {{--                                        <input type="text" tabindex="2" onkeypress='validate(event)' name="from_visit_search" class="form-control form-control-sm" id="visit_search">--}}
                                    {{--                                    </div>--}}



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Job#</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="job_no" class="form-control form-control-sm"
                                               id="job_no">
                                    </div>


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Technician</label>
                                    </div>


                                    <div class=" col-1-5">
                                        <input tabindex="4" type="text" name="client_name" class="form-control form-control-sm"
                                               id="client_name">
                                    </div>

                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">From</label>
                                    </div>

                                    {{--                                    <div class=" col-1-5">--}}
                                    {{--                                        <input type="text" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"--}}
                                    {{--                                               value="{{$from_date}}" id="from_date" placeholder="Choose...">--}}
                                    {{--                                    </div>--}}
                                    <div class=" col-1-5">
                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"
                                               value="" id="from_date" placeholder="Choose...">
                                    </div>






                                </div>


                                <div class="row">



                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Status</label>
                                    </div>


                                    <div class=" col-1-5">
{{--                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm"--}}
{{--                                               id="status">--}}
                                        <select tabindex="4" type="text" name="status" class="form-control form-control-sm"
                                               id="status">
                                            <option selected disabled>Select Option</option>
                                            <option>Pending</option>
                                            <option>Assign</option>
                                            <option>Close</option>
                                            <option>Paid</option>
                                            <option>Credit</option>
                                        </select>
                                    </div>





                                    {{--                                    <div class="col-1-5">--}}
                                    {{--                                        <div class="form-group mb-0">--}}

                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}


                                    {{--                                    <div class=" col-1-5">--}}
                                    {{--                                        <label class="float-right mt-2" for=""></label>--}}
                                    {{--                                    </div>--}}


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Warranty</label>
                                    </div>
                                    <div class="col-1-5">
                                        <select id="warranty" name="warranty">
                                            {{--                                            <option value="0" selected disabled>Select</option>--}}

                                            <option value=""  selected disabled>Select Warranty</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>

                                        </select>
                                    </div>






                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">To</label>
                                    </div>



                                    {{--                                    <div class=" col-1-5">--}}
                                    {{--                                        <input type="text" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"--}}
                                    {{--                                               value="{{$to_date}}" id="to_date" placeholder="Choose...">--}}
                                    {{--                                    </div>--}}
                                    <div class=" col-1-5">
                                        <input type="date" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"
                                               value="" id="to_date" placeholder="Choose...">
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
                                        <th>Job No</th>
                                        <th>Technician</th>
                                        <th>Warrenty</th>
                                        <th>Status</th>
                                        <th>Cost</th>
                                        <th>Issue</th>
                                        <th>Return</th>
                                        <th>Expense</th>
                                        <th>Profit</th>
                                        <th>Date</th>



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



                                    @foreach($query as $index=>$brand)
                                        @php

                                        @endphp
                                        <tr>

                                            <td>{{$brand->ji_id}}</td>
                                            <td>{{$brand->tech_name}}</td>

                                            <td>{{$brand->ji_warranty_status}}</td>
                                            <td>{{$brand->ji_job_status}}</td>

                                            <td>{{$brand->ji_estimated_cost}}</td>

                                            @php
                                                $var_return = 0;
                                                $var_issue = 0;
                                            @endphp


                                            @foreach($issue as $issuei)
                                                @if($issuei->ji_id == $brand->ji_id)

                                                    @php
                                                      $var_issue = $issuei->total_issue;
                                                    @endphp

                                                @endif
                                            @endforeach

                                            <td>-{{$var_issue}}</td>


                                        @foreach($retured as $return)
                                                @if($return->ji_id == $brand->ji_id)

                                                    @php
                                                        $var_return = $return->total_return;
                                                    @endphp

                                                @endif
                                        @endforeach
                                            <td>{{$var_return}}</td>


{{--                                            @if($retured[0]->ji_id == $brand->ji_id || $issue[0]->ji_id == $brand->ji_id)--}}

                                            @php
                                                $exp = $var_return - $var_issue;
                                            @endphp

                                                    <td>{{$exp}}</td>


                                                    <td>{{$brand->ji_estimated_cost + $exp}}</td>
                                            <td>{{ date('d-m-Y', strtotime( $brand->ji_recieve_datetime )) }}</td>

{{--                                            @endif--}}







                                        </tr>

                                        @php
                                            $sr++; (!empty($segmentSr) && $countSeg !== '0') ?  : $countSeg++;
                                        @endphp
                                    @endforeach


                                    </tbody>
                                    <tr>
{{--                                        <td>{{$total_amount}}</td>--}}
                                    </tr>
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
            $("#status").select2();
            $("#warranty").select2();
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
