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
                        <p class="mb-1">Company Information</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Company Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Company Information</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Party</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('store_company_info')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="party">Company Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="name"
                                                           name="name" value="{{$company_info->com_name}}" placeholder="Enter a Company.." autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="party">CEO

                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="ceo"
                                                           name="ceo" value="{{$company_info->com_ceo}}" placeholder="Enter a Address.." autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="party">Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="number"
                                                           name="number" value="{{$company_info->com_number}}" placeholder="Enter a Number.." autofocus onkeypress="return numberFormatter(event)">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="party">Complain Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="cnumber"
                                                           name="cnumber" value="{{$company_info->com_complain}}" placeholder="Enter a Complain Number.." autofocus onkeypress="return numberFormatter(event)">
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="party">Address

                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="address"
                                                           name="address" value="{{$company_info->com_address}}" placeholder="Enter a Address.." autofocus>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="remarks">Services<span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" id="services" name="services" rows="2" >{{$company_info->com_services}}</textarea>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="remarks">Instructions <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" id="instructions" name="instructions" rows="2" placeholder="instructions">{{$company_info->com_instructions}}</textarea>
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

            let party = document.getElementById("party"),
                number = document.getElementById("number"),
                validateInputIdArray = [
                    party.id,
                    number.id
                ];
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
            }else{
                return false;
            }
        }
        function validateInventoryInputs(InputIdArray) {
            let i = 0,
                flag = false,
                getInput = '';

            for (i; i < InputIdArray.length; i++) {
                if (InputIdArray) {
                    getInput = document.getElementById(InputIdArray[i]);
                    if (getInput.value === '' || getInput.value === 0) {
                        getInput.focus();
                        getInput.classList.add('bg-danger');
                        flag = false;
                        break;
                    } else {
                        getInput.classList.remove('bg-danger');
                        flag = true;
                    }
                }
            }
            return flag;
        }
        $(document).ready(function () {
            $('#form').validate({ // initialize the plugin

                rules: {
                    party: {
                        // required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    }
                },
                messages: {
                    party: {
                        // required: "Required"
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
