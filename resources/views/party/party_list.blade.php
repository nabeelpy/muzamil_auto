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
                        <p class="mb-1">Party List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Party</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Party List</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Party List</h4>
                            <!-- Ipartyhim add -->
                            {{--                        <button >--}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button>--}}
                        </div>
                        <div class="card-body">



                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Party Name</th>
                                        <th>Party Number</th>
                                        <th>Party Address</th>
                                        {{--                                            <th>Created By</th>--}}
                                        <th>Date</th>
                                        {{--                                            <th>Updated At</th>--}}
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



                                    @foreach($query as $party)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td>{{$party->party_name}}</td>
                                            <td>{{$party->party_number}}</td>
                                            <td>{{$party->party_address}}</td>
                                            {{--                                        <td>{{$party->name}}</td>--}}
                                            <td> {{ date('d-m-Y', strtotime( $party->party_created_at )) }}</td>
                                            {{--                                        <td>{{$party->party_updated_at}}</td>--}}
                                            <td><a href="{{route('edit_party',$party->party_id)}}"><i class="fas fa-edit"></i></a></td>
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
            // $('#form').validate({ // initialize the plugin
            //
            //     rules: {
            //         party: {
            //             required: true,
            //             pattern: /^[A-Za-z0-9. ]{3,30}$/
            //         }
            //     },
            //     messages: {
            //         party: {
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
