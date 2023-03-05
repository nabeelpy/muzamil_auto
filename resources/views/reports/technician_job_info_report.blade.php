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
                        <p class="mb-1">Time Report</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Time Report</a></li>

                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Time Report</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button >--}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('technician_job_info_report')}}" method="get">

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
{{--                                            <label class="float-right mt-2" for="">Client</label>--}}
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

                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <label class="float-right mt-2" for="">Job Start</label>
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


                                    <div class=" col-2">
                                        <input tabindex="4" type="text" name="job_no" class="form-control form-control-sm"
                                               id="job_no">
                                    </div>


                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Technician</label>
                                    </div>


                                    <div class=" col-2">
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
                                    <div class=" col-2">
                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"
                                                id="from_date" placeholder="01-01-2021">
                                    </div>






                                </div>


{{--                                <div class="row" style="margin-left: 300px">--}}
                                <div class="row">

                                    <div class=" col-3">
{{--                                        <label class="float-right mt-2" for="">Status</label>--}}
                                    </div>

                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">Status</label>
                                    </div>


                                    <div class=" col-2" >
                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm"
                                               id="status">
                                    </div>





                                    <div class=" col-1">
                                        <label class="float-right mt-2" for="">To</label>
                                    </div>


                                    <div class=" col-2">
                                        <input type="date" name="to_date" tabindex="7" class="form-control date advance_search form-control-sm"
                                               id="to_date" placeholder="01-01-2021">
                                    </div>



                                    <div class="col-1">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col2"></div>

                                </div>

                            </form>




                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Job No</th>
                                        <th>Technician Name</th>
                                        <th>Status</th>
                                        <th>Job Start Date</th>
                                        <th>Job End Date</th>
                                        <th>Job Days</th>
                                        <th>Technician Start Date</th>
                                        <th>Technician End Date</th>
                                        <th>Technician Days</th>
                                        <th>Today Date</th>
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



                                    @foreach($query as $index=>$brand)
                                        <tr>
                                            <td>{{$brand->ji_id}}</td>
                                            <td>{{$brand->tech_name}}</td>
                                            <td>{{$brand->ji_job_status}}</td>
{{--                                            <td>{{$brand->name}}</td>--}}

{{--                                            <td>{{$brand->cli_name}}</td>--}}
{{--                                            <td>{{$brand->cli_number}}</td>--}}
{{--                                            <td>{{$brand->ji_warranty_status}}</td>--}}
{{--                                            <td>{{$brand->bra_name}}</td>--}}
{{--                                            <td>{{$brand->cat_name}}</td>--}}
{{--                                            <td>{{$brand->mod_name}}</td>--}}
{{--                                            <td>{{$brand->ji_equipment}}</td>--}}

{{--                                            <td>{{$brand->ji_job_status}}</td>--}}
{{--                                            <td>{{$brand->ji_serial_no}}</td>--}}
{{--                                            <td>{{$brand->ji_estimated_cost}}</td>--}}

                                            {{--                                            <td>{{$complain_items->jii_item_name}}</td>--}}
                                            {{--                                            <td>{{$brand->ji_recieve_datetime}}</td>--}}
                                            {{--                                            <td>{{$brand->ji_recieve_datetime}}</td>--}}
                                            {{--                                            <td>{{$brand->ji_delivery_datetime}}</td>--}}

{{--                                            @foreach($complain_items as $complain)--}}

{{--                                                @if($complain->jii_ji_id == $brand->ji_id)--}}
{{--                                                    <td>{{$complain->jii_item_name}}</td>--}}
{{--                                                @endif--}}

{{--                                            @endforeach--}}


{{--                                            @foreach($accessory_items as $complain)--}}

{{--                                                @if($complain->jii_ji_id == $brand->ji_id)--}}
{{--                                                    <td>{{$complain->jii_item_name}}</td>--}}
{{--                                                    --}}{{--                                               --}}
{{--                                                @endif--}}

{{--                                            @endforeach--}}

                                            @php


                                                $datetime1 = new DateTime(date('d-m-Y', strtotime($brand->ji_recieve_datetime)));
                                                $datetime2 = new DateTime(date('d-m-Y', strtotime($brand->ji_delivery_datetime)));
                                                //$datetime2 = new DateTime(date("Y-m-d"));
                                                //$interval = $datetime2->diff($datetime1);
                                                $interval = $datetime1->diff($datetime2);
                                                $days = $interval->format('%a');//now do whatever you like with $days
                                                //echo $days;




                                                $techdate1 = new DateTime(date('d-m-Y', strtotime($brand->jitt_created_at)));
                                                $techdate2 = new DateTime(date('d-m-Y', strtotime($brand->jc_created_at)));
                                                //$datetime2 = new DateTime(date("Y-m-d"));
                                                //$interval = $datetime2->diff($datetime1);
                                                $tech_interval = $techdate1->diff($techdate2);
                                                $tech_days = $tech_interval->format('%a');//now do whatever you like with $days
                                                //echo $tech_days;


                                                $not_competed_date1 = new DateTime(date('d-m-Y', strtotime($brand->jitt_created_at)));
                                                $not_competed_date2 = new DateTime(date("d-m-Y"));
                                                //$datetime2 = new DateTime(date("Y-m-d"));
                                                //$interval = $datetime2->diff($datetime1);
                                                $not_competed_interval = $not_competed_date1->diff($not_competed_date2);
                                                $not_competed_days = $not_competed_interval->format('%a');//now do whatever you like with $days


                                            @endphp

                                            <td>{{date('d-m-Y', strtotime($brand->ji_recieve_datetime))}}</td>
                                            <td>{{date('d-m-Y', strtotime($brand->ji_delivery_datetime))}}</td>
                                            <td>{{$days}}</td>
                                            <td>{{date('d-m-Y', strtotime($brand->jitt_created_at))}}</td>

                                            @if(date('d-m-Y', strtotime($brand->jc_created_at)) == "01-01-1970")
                                                <td>Not Completed</td>
                                                <td>{{$not_competed_days}}</td>
                                            @else
                                                <td>{{date('d-m-Y', strtotime($brand->jc_created_at))}}</td>
                                                <td>{{$tech_days}}</td>

                                            @endif



                                            <td>{{date("d-m-Y")}}</td>
{{--                                            <td>{{$brand->jitt_created_at - date("Y-m-d")}}</td>--}}
{{--                                            <td><a href="{{route('job_info.edit',$brand->ji_id)}}"><i class="fas fa-edit"></i></a></td>--}}

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
