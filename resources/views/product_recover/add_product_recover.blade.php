@extends('layouts.theme')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Product Recover</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Product Recover</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Product Recover</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Product Recover</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('product_recover.store')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="part_name">Part Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="part_name" name="part_name">
                                                        <option value="0">Select Part</option>
                                                        @foreach($parts as $account)
                                                            <option value="{{$account->par_id}}">
                                                                {{$account->par_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="parts_qty">Parts Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="parts_qty"
                                                           name="parts_qty" placeholder="Enter a Parts Quantity.." onkeypress="return numbersOnly(event)">
                                                </div>
                                            </div>


                                            <div class="form-group row" >
                                                <label class="col-lg-4 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="Remarks"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
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
        function maincheckForm() {
                    let part_name = document.getElementById("part_name"),
                    parts_qty = document.getElementById("parts_qty"),
                    validateInputIdArray = [
                        part_name.id,
                        parts_qty.id
                        ];

                    if (part_name.value == 0) {
                        part_name.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            }
            else{
                part_name.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }

                    // return validateInventoryInputs(validateInputIdArray);

                    var ok = validateInventoryInputs(validateInputIdArray);

                    if(ok){
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
            $("#part_name").select2();
            $(".select2-selection--single").focus();
            $('#form').validate({ // initialize the plugin

                // rules: {
                //     part_name:{
                //         required: true,
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     },
                //     parts_qty: {
                //         required: true,
                //
                //     }
                // },
                // messages: {
                //     part_name: {
                //         required: "Required"
                //     },
                //     parts_qty: {
                //         required: "Required",
                //         pattern:"Only Digits"
                //     }
                //
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
    </script>
@stop
