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
                        <p class="mb-1">Cash Payment Voucher List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Cash Invoice</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Cash Payment Voucher</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Cash Payment Voucher List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cash Payment Voucher List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">

{{--                            <form action="{{route('cash_receipt_voucher.index')}}" method="get">--}}

{{--                                <div class="row">--}}

{{--                                    <div class="col-2">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <label class="float-left" for="">Search Model</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="col-2">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <label for="">Search Category</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                    <div class="col-2">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <label class="float-left" for="">Search Brand</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                </div>--}}



{{--                                --}}{{--                second--}}
{{--                                <div class="row">--}}

{{--                                    <div class="col-2">--}}
{{--                                        <div class="form-group mb-0">--}}

{{--                                            <input  type="text" tabindex="1" id="search_model" name="search_model" class="form-control form-control-sm"--}}
{{--                                                    value="{{$search_model}}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="col-2">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            --}}{{--                                            <select id="search_category" name="search_category">--}}

{{--                                            --}}{{--                                                <option value="">Select Category</option>--}}
{{--                                            --}}{{--                                                @foreach($categorys as $account)--}}
{{--                                            --}}{{--                                                    <option value="{{$account->cat_name}}">--}}
{{--                                            --}}{{--                                                        {{$account->cat_name}}</option>--}}
{{--                                            --}}{{--                                                @endforeach--}}

{{--                                            --}}{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                    <div class=" col-2">--}}
{{--                                        --}}{{--                                        <select id="bra_name" name="bra_name">--}}

{{--                                        --}}{{--                                            <option value="">Select Brand</option>--}}
{{--                                        --}}{{--                                            @foreach($brands as $account)--}}
{{--                                        --}}{{--                                                <option value="{{$account->bra_name}}">--}}
{{--                                        --}}{{--                                                    {{$account->bra_name}}</option>--}}
{{--                                        --}}{{--                                            @endforeach--}}

{{--                                        --}}{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                    <div class="col">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">--}}
{{--                                                Search--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                                <div class="row">--}}



{{--                                </div>--}}


{{--                                --}}{{--                <input type="text" id="avg_rating_search" onkeyup= search_avg()" placeholder="Search for names..">--}}

{{--                                --}}{{--                <div class="row">--}}
{{--                                --}}{{--                    <div class="filter_buttons">--}}
{{--                                --}}{{--                        <input type="submit" class="btn btn-primary btn-sm" value="Search">--}}
{{--                                --}}{{--                        <div class="btn-group">--}}
{{--                                --}}{{--                            <button type="button" class="btn btn-secondary btn-sm" onclick="prnt_cus('pdf')">Print</button>--}}
{{--                                --}}{{--                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                --}}{{--                                <span class="caret"></span>--}}
{{--                                --}}{{--                                <span class="sr-only">Toggle Dropdown</span>--}}
{{--                                --}}{{--                            </button>--}}
{{--                                --}}{{--                            <div class="dropdown-menu dropdown-menu-right print_act_drp hide_column" x-placement="bottom-end">--}}
{{--                                --}}{{--                                <button type="button" class="dropdown-item" id="" onclick="prnt_cus('download_pdf')">--}}
{{--                                --}}{{--                                    <i class="fa fa-print"></i> Download PDF--}}
{{--                                --}}{{--                                </button>--}}
{{--                                --}}{{--                                <button type="button" class="dropdown-item"  onclick="prnt_cus('download_excel')">--}}
{{--                                --}}{{--                                    <i class="fa fa-file-excel-o"></i> Excel Sheet--}}
{{--                                --}}{{--                                </button>--}}
{{--                                --}}{{--                            </div>--}}
{{--                                --}}{{--                        </div>--}}
{{--                                --}}{{--                    </div>--}}
{{--                                --}}{{--                </div>--}}
{{--                            </form>--}}

                            <form action="{{route('cash_payment_voucher.index')}}" method="get">

                                <div class="row">

                                    <div class="col-1-5">
                                        <div class="form-group">
                                            <label for="">Account #</label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input  type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"
                                                    value="{{$job_no}}">
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
{{--                                            <label for="">Account#</label>--}}
{{--                                        </div>--}}
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
{{--                                            <input type="text" tabindex="1" id="job_no" name="job_no" class="form-control form-control-sm"--}}
{{--                                                   value="{{$job_no}}">--}}
{{--                                        </div>--}}
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
                                        <th>Account</th>
                                        <th>Recieved By</th>
                                        <th>Remarks</th>
                                        <th>Amount</th>
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



                                    @foreach($query as $brand)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td>{{$brand->ca_name}}</td>
                                            <td>{{$brand->jpv_deliver_to}}</td>
                                            <td>{{$brand->jpv_remarks}}</td>
                                            <td>{{$brand->jpv_amount}}</td>
                                            <td>{{ date('d-m-Y', strtotime( $brand->jpv_created_at )) }}</td>
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

            $("#bra_name").select2();
            $("#search_category").select2();


            $('#form').validate({ // initialize the plugin

                rules: {
                    brand: {
                        required: true,
                        pattern: /^[A-Za-z0-9. ]{3,30}$/
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
