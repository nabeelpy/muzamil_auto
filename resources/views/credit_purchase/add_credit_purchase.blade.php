@extends('layouts.theme')

@section('content')


    <style>
        button, input {
            overflow: vipible;
            border: none;
        }
    </style>


    <!--**********************************
            Content body start
        ***********************************-->
    {{--    <div class="alert alert-warning alert-dismispible fade show" role="alert" style="    z-index: 4;--}}
    {{--    popition: absolute;--}}
    {{--    width: 100%;">--}}
    {{--        <p style="width: 30%;--}}
    {{--    margin: auto;"--}}
    {{--        ><strong>Holy guacamole!</strong> You should check in on some of those fields below.</p>--}}
    {{--        <strong>Holy guacamole!</strong> You should check in on some of those fields below.--}}
    {{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    {{--    </div>--}}
    {{--    <div class="alert alert-warning alert-dismispible fade show" role="alert" style="popition: absolute;z-index: 4;">--}}
    {{--        <strong>Holy guacamole!</strong> You should check in on some of those fields below.--}}
    {{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    {{--    </div>--}}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Credit Purchase Invoice</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Cash Invoices</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Credit Purchase Invoice</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Credit Purchase Invoice</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="alert alert-danger " style="display: none" id="alert">
                <a href="#" class="close" aria-label="close" onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
                <p style="margin: auto;width: 50%;"><strong>Danger!</strong> Amount can not be greater than estimate cost.</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Credit Purchase Invoice</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('store_credit_purchase')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group row">


                                                {{--                                                <label class="col-lg-2 col-form-label" for="job_no">Job No--}}
                                                {{--                                                    <span class="text-danger">*</span>--}}
                                                {{--                                                </label>--}}
                                                {{--                                                <div class="col-lg-4">--}}
                                                {{--                                                    <select id="job_no" name="job_no" tabindex="1">--}}
                                                {{--                                                        <option value="" selected disabled>Select</option>--}}
                                                {{--                                                        @foreach($job_number as $job_no)--}}
                                                {{--                                                            <option value="{{$job_no->ji_id}}">--}}
                                                {{--                                                                {{$job_no->ji_id}}| {{$job_no->ji_title}}--}}
                                                {{--                                                            </option>--}}
                                                {{--                                                        @endforeach--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                                <label class="col-lg-2 col-form-label" for="cash_account">Cash Account
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-4">
                                                    <select id="cash_account" name="cash_account" tabindex="2">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach($cash_accounts as $cash_account)
                                                            <option value="{{$cash_account->ca_id}}">
                                                                {{$cash_account->ca_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <label class="col-lg-2 col-form-label" for="amount">Purchase Invoice #
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-4">
                                                    <input type="text" readonly onkeyup="calculation()" class="form-control" id="invoice"
                                                           name="invoice" value="{{$credit_purchase_invoice_detail->pi_id}}" placeholder="Enter a Amount.." tabindex="3" onkeypress="return numbersOnly(event)">
                                                </div>



                                                <label hidden class="col-lg-2 col-form-label" for="amount">Party ID
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div hidden class="col-lg-4">
                                                    <input type="text" readonly onkeyup="calculation()" class="form-control" id="party"
                                                           name="party" value="{{$credit_purchase_invoice_detail->pi_party_id}}" placeholder="Enter a party.." tabindex="3" onkeypress="return numbersOnly(event)">
                                                </div>

                                            </div>

                                            <div class="form-group row">



                                                <label class="col-lg-2 col-form-label" for="amount">Amount
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-4">
                                                    <input type="text"  onkeyup="calculation()" class="form-control" id="amount"
                                                           name="amount" placeholder="Enter a Amount.." tabindex="3" onkeypress="return numbersOnly(event)">
                                                </div>


                                                <label class="col-lg-2 col-form-label" for="amount">Discount
                                                </label>
                                                <div class="col-lg-4">
                                                    <input type="text"  onkeyup="calculation()" class="form-control" id="discount"
                                                           name="discount" placeholder="Enter a Discount.." tabindex="4" onkeypress="return numbersOnly(event)">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-4">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Remarks" tabindex="5"></textarea>
                                                </div>



                                                <label class="col-lg-2 col-form-label" for="estimated_cost">Estimated Cost
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-4">
                                                    <input readonly type="text" class="form-control" id="estimated_cost"
                                                           name="estimated_cost" value="{{$credit_purchase_invoice_detail->pi_remaining}}" placeholder="Enter Estimated Cost..">
                                                </div>



                                                <label hidden class="col-lg-2 col-form-label" for="estimated_cost">Real Estimated Cost
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div hidden class="col-lg-4">
                                                    <input readonly type="text" value="{{$credit_purchase_invoice_detail->pi_grand_total}}" class="form-control" id="real_estimated_cost"
                                                           name="real_estimated_cost" placeholder="Enter Estimated Cost..">
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="remaining_estimated_cost">Remaining Estimated Cost

                                                </label>
                                                <div class="col-lg-4">
                                                    <input readonly type="text" class="form-control" id="remaining_estimated_cost"
                                                           name="remaining_estimated_cost"  placeholder="Enter Remaining Estimated Cost..">
                                                </div>

                                                {{--                                                <label class="col-lg-2 col-form-label" for="amount">Warrenty Vendor--}}
                                                {{--                                                    <span class="text-danger">*</span>--}}
                                                {{--                                                </label>--}}
                                                {{--                                                <div class="col-lg-4">--}}
                                                {{--                                                    <input readonly type="text" class="form-control" id="warrenty"--}}
                                                {{--                                                           name="warrenty" placeholder="Warrenty Vendor">--}}
                                                {{--                                                </div>--}}


                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-7 ml-auto">
                                                    <button type="submit" class="btn btn-primary" tabindex="6">Save</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </form>
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
                                <h4 class="modal-title text-black">Purchases Invoice Detail</h4>
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
                        function maincheckForm() {
                            let cash_account = document.getElementById("cash_account"),
                                amount = document.getElementById("amount"),
                                estimated_cost = document.getElementById("estimated_cost"),
                                validateInputIdArray = [
                                    cash_account.id,
                                    amount.id,
                                    estimated_cost.id,
                                ];


                            if (cash_account.value == 0) {
                                cash_account.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                                return false;
                            }
                            else{
                                cash_account.nextSibling.childNodes[0].childNodes[0].style.border = ""
                            }
                            if (document.getElementById("remaining_estimated_cost").value < 0){
                                // alert("Amount can not be greater than estimate cost");
                                document.getElementById("alert").style.display = "block";
                                return false;
                            }

                            // return false;
                            // return validateInventoryInputs(validateInputIdArray);

                            var ok = validateInventoryInputs(validateInputIdArray);

                            if(ok){
                                add_purchase()
                                if(counter == 0){
                                    $("#complain").addClass('bg-danger');
                                    return false;
                                }
                                else if(counter2 == 0){
                                    $("#accessories").addClass('bg-danger');
                                    return false;
                                }else{
                                    return true;
                                }
                            }
                            else{
                                return false;
                            }
                        }

                        $(document).ready(function () {
                            $("#job_no").select2();
                            $(".select2-selection--pingle").focus();
                            $("#cash_account").select2();

                            $('#form').validate({ // initialize the plugin

                                // rules: {
                                //     job_no: {
                                //         required: true,
                                //     },
                                //     parts: {
                                //         required: true,
                                //     },
                                //     qty: {
                                //         required: true,
                                //     },
                                //     rate: {
                                //         required: true,
                                //     },
                                //     amount: {
                                //         required: true,
                                //     },
                                //     discount: {
                                //         required: true,
                                //     }
                                // },
                                // messages: {
                                //     job_no: {
                                //         required: "Required",
                                //     },
                                //     parts: {
                                //         required: "Required",
                                //     },
                                //     qty: {
                                //         required: "Required",
                                //     },
                                //     rate: {
                                //         required: "Required",
                                //     },
                                //     amount: {
                                //         required: "Required",
                                //     },
                                //     discount: {
                                //         required: "Required",
                                //     }
                                //
                                // },

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





                        {{--jQuery("#job_no").change(function () {--}}


                        {{--    var dropDown = document.getElementById('job_no');--}}
                        {{--    var job_id = dropDown.options[dropDown.selectedIndex].value;--}}

                        {{--    jQuery.ajaxSetup({--}}
                        {{--        headers: {--}}
                        {{--            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')--}}
                        {{--        }--}}
                        {{--    });--}}

                        {{--    jQuery.ajax({--}}
                        {{--        url: "{{route('get_estimate_for_purchase')}}",--}}
                        {{--        data: {job_id: job_id},--}}
                        {{--        type: "GET",--}}
                        {{--        cache: false,--}}
                        {{--        dataType: 'json',--}}
                        {{--        success: function (data) {--}}

                        {{--            console.log(data);--}}

                        {{--            $.each(data,function (index, value) {--}}
                        {{--                $warrenty = value.vendor_name;--}}
                        {{--                $estimated_cost = value.ji_remaining;--}}
                        {{--                $real_estimated_cost = value.ji_estimated_cost;--}}
                        {{--            });--}}
                        {{--            jQuery("#estimated_cost").val($estimated_cost);--}}
                        {{--            jQuery("#real_estimated_cost").val($real_estimated_cost);--}}
                        {{--            jQuery("#warrenty").val($warrenty);--}}
                        {{--        },--}}
                        {{--        error: function (jqXHR, textStatus, errorThrown) {--}}
                        {{--            alert(jqXHR.responseText);--}}
                        {{--            alert(errorThrown);--}}
                        {{--        }--}}
                        {{--    });--}}
                        {{--});--}}




                        function calculation(){

                            var amount = $("#amount").val();
                            var discount = $("#discount").val();
                            var estimated_cost = $("#estimated_cost").val();
                            var remaining_estimated_cost = $("#remaining_estimated_cost").val();

                            var amount_float = parseFloat(amount);

                            if(isNaN(parseFloat(discount))){
                                var discount_float = 0;
                            }else {
                                var discount_float = parseFloat(discount);
                            }

                            var total_amount = amount_float + discount_float;


                            var calc_remaining_estimated_cost = estimated_cost - total_amount;
                            $("#remaining_estimated_cost").val(calc_remaining_estimated_cost);

                        }



                    </script>
                    @if (Session::has('pi_id'))
                        <script>
                            // alert("id mill gai");

                            jQuery("#table_body").html("");

                            var id = '{{ Session::get("pi_id") }}';

                            $('.modal-body').load('{{url("purchase_invoice_modal_view_details/view/") }}' + '/' + id, function () {
                                $("#myModal").modal({show: true});


                                // // for print preview to not remain on screen
                                // if ($('#quick_print').is(":checked")) {
                                //
                                //     setTimeout(function () {
                                //         var abc = $("#printi");
                                //         abc.click();
                                //
                                //
                                //         $('.invoice_sm_mdl').css('display', 'none');
                                //         $('.cancel_button').click();
                                //         $('#product').focus();
                                //     }, 100);
                                // }


                            });
                            function check_stock() {


                                if (counter == 0) {
                                    document.getElementById("alert").style.display = "block";
                                    return false;
                                }

                                var disc_percentage = 0;
                                var disc_amount = jQuery("#disc_amount").val();

                                var count_total = 0;
                                var count2_total = 0;
                                var qty;
                                var pro_code;
                                var pro_field_id_title;
                                var pro_field_id;

                                $('input[name="parts_name[]"]').each(function (pro_index) {
                                    pro_code = $(this).val();
                                    pro_field_id_title = $(this).attr('id');
                                    pro_field_id = pro_field_id_title.match(/\d+/); // 123456

                                    qty = jQuery("#qty" + pro_field_id).val();
                                    st_qty = jQuery("#st_qty" + pro_field_id).val();

                                    // grand_total = +grand_total + +product_amount;
                                    // item_total = +item_total + +product_quantity;

                                    if (parseFloat(qty) < parseFloat(st_qty)){
                                        // alert("work");
                                        count_total++;
                                        // $("#qty"+count).val("0");
                                    }
                                    count2_total++;
                                });
                                console.log(count_total,count2_total);
                                if(count_total == count2_total)
                                    return true;
                                else{
                                    alert("Do not have enough quantity");
                                    return false;
                                }
                            }


                        </script>
    @endif


@stop
