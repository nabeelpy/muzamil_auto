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
        body{
            color: black;
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
                        <p class="mb-1">Employee Registration List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Employee</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee Registration List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Employee Registration List</h4>
                            <!-- Ibrahim add -->
{{--                        <button >--}}
                                <div class="srch_box_opn_icon">
                                    <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                                </div>
{{--                        </button>--}}
                        </div>
                        <div class="card-body">

                            <form action="{{route('employee_registration.index')}}" method="get">


                                    <div class="row">

                                        <div class="col-1">
                                            <div class="form-group mb-0">
                                                <label class="float-right mt-2" for=""><h5>Search</h5></label>
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


{{--                                        <div class=" col-1">--}}
{{--                                            <label class="float-right mt-2" for="">Role</label>--}}
{{--                                        </div>--}}


{{--                                        <div class=" col-1-5">--}}
{{--                                            <input tabindex="4" type="text" name="role" class="form-control form-control-sm"--}}
{{--                                                   id="role">--}}
{{--                                        </div>--}}


                                        <div class=" col-1">
                                            <label class="float-right mt-2" for="">Search</label>
                                        </div>


                                        <div class=" col-1-5">
                                            <input tabindex="4" type="text" name="name" class="form-control form-control-sm"
                                                   id="name">
                                        </div>


                                        <div class=" col-1">
                                            <label class="float-right mt-2" for="">Login Status</label>
                                        </div>


                                        <div class=" col-1-5">
                                            {{--                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm"--}}
                                            {{--                                               id="status">--}}

                                            <select id="login_status" name="login_status">
                                                {{--                                            <option value="0" selected disabled>Select</option>--}}

                                                <option value=""  selected disabled>Select Status</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>


                                            </select>
                                        </div>

{{--                                        <div class=" col-1">--}}
{{--                                            <label class="float-right mt-2" for="">CNIC</label>--}}
{{--                                        </div>--}}


{{--                                        <div class=" col-1-5">--}}
{{--                                            <input tabindex="4" type="number" name="cnic" class="form-control form-control-sm"--}}
{{--                                                   id="cnic" placeholder="12345-1234567-1">--}}
{{--                                        </div>--}}



                                        <div class=" col-1">
                                            <label class="float-right mt-2" for="">Employee Status</label>
                                        </div>


                                        <div class=" col-1-5">
                                            {{--                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm"--}}
                                            {{--                                               id="status">--}}

                                            <select id="emp_status" name="emp_status">
                                                {{--                                            <option value="0" selected disabled>Select</option>--}}

                                                <option value=""  selected disabled>Select Status</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>


                                            </select>
                                        </div>


                                        <div class=" col-1">
                                            <label class="float-right mt-2" for="">Technician Status</label>
                                        </div>


                                        <div class=" col-1-5">
                                            {{--                                        <input tabindex="4" type="text" name="status" class="form-control form-control-sm"--}}
                                            {{--                                               id="status">--}}

                                            <select id="tech_status" name="tech_status">
                                                {{--                                            <option value="0" selected disabled>Select</option>--}}

                                                <option value=""  selected disabled>Select Status</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>


                                            </select>
                                        </div>


                                        <div class="col-1" >
                                            <div class="form-group">
                                                <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">
                                                    Search
                                                </button>
                                            </div>
                                        </div>

                                    </div>





                                </form>





                                <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display table-freez" style="min-width: 845px;background: #fff;">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Gender</th>
                                        <th>CNIC</th>
                                        <th>Number</th>
                                        <th>Address</th>
                                        <th>User Email</th>
                                        <th>Role</th>
{{--                                        <th>Role</th>--}}
                                        <th>Employee Status</th>
                                        <th>Login Status</th>
                                        <th>Technician Status</th>
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



                                    @foreach($query as $employee_registration)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td>{{$employee_registration->name}}</td>
                                            <td>{{$employee_registration->f_name}}</td>
                                            <td>{{$employee_registration->gender}}</td>
                                            <td>{{$employee_registration->cnic}}</td>
                                            <td>{{$employee_registration->number}}</td>
                                            <td>{{$employee_registration->address}}</td>
                                            <td>{{$employee_registration->email}}</td>
                                            <td>
                                                @if(!empty($employee_registration->getRoleNames()))
                                                    @foreach($employee_registration->getRoleNames() as $v)
{{--                                                        <label class="badge badge-success">{{ $v }}</label>--}}
                                                        {{ $v }}
                                                    @endforeach
                                                @endif
                                            </td>
{{--                                            <td>{{$employee_registration->role}}</td>--}}
                                            <td>{{$employee_registration->employee_status == 1 ? 'Yes' : ''}}</td>
{{--                                            <td>{{$employee_registration->employee_status}}</td>--}}
                                            <td>{{$employee_registration->login_status == 1 ? 'Yes' : ''}}</td>

                                            <td>{{$employee_registration->work_status == 1 ? 'Yes' : ''}}</td>




                                            <td><a href="{{route('employee_registration.edit',$employee_registration->id)}}"><i class="fas fa-edit"></i></a></td>

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

            $("#login_status").select2();
            $("#emp_status").select2();
            $("#tech_status").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    brand: {
                        required: true,
                        pattern: /^[A-Za-z0-9. ]{1,30}$/
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
