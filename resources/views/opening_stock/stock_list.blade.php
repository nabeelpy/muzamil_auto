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
                        <p class="mb-1">Stock Movement List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement List</a></li>
{{--                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Transfer</a></li>--}}
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Stock Movement List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('opening_stock.index')}}" method="get">

                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Job#</label>
                                        </div>
                                    </div>



                                    <div class="col-2">
                                        <label class="float-left" for="">Date From</label>
                                    </div>



                                    <div class="col-1">
                                        <label class="float-left" for="">Date To</label>
                                    </div>




                                </div>



                                {{--                second--}}
                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group mb-0">
                                            <input  type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"
                                                    value="{{$job_no}}">
                                        </div>
                                    </div>


                                    <div class=" col-1-5">
                                        <input type="date" tabindex="6" name="from_date" class="form-control date advance_search form-control-sm"
                                               value="{{$from_date}}" id="from_date" placeholder="Choose...">
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
                                        <th>Part</th>
                                        <th>Job</th>
                                        <th>Type</th>


                                        <th>Stock In Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>

                                        <th>Stock Out Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>

{{--                                        <th>Stock Hold Qty</th>--}}
                                        <th>Job Hold Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>

                                        <th>Total Qty</th>
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
                                        <tr>
                                            {{--                                            <td>{{$sr}}</td>--}}
                                            <td>{{$sr}}</td>
                                            <td>{{$brand->par_name}}</td>
                                            <td>{{$brand->sto_job_id}}</td>
                                            <td>{{$brand->sto_type}}</td>

                                            <td>{{$brand->sto_in}}</td>
                                            <td>{{$brand->sto_in_rate}}</td>
                                            <td>{{$brand->sto_in_amount}}</td>

                                            <td>{{$brand->sto_out}}</td>
                                            <td>{{$brand->sto_out_rate}}</td>
                                            <td>{{$brand->sto_out_amount}}</td>

                                            <td>{{$brand->sto_hold}}</td>
                                            <td>{{$brand->sto_hold_rate}}</td>
                                            <td>{{$brand->sto_hold_amount}}</td>


                                            <td>{{$brand->sto_total}}</td>
                                            <td>{{ date('d-m-Y', strtotime( $brand->sto_created_at )) }}</td>

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
