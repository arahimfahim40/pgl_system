@extends('admin.layout.main')
@section('title','Clear Log')

@section('content')
    <div class="site-content">
        <div class="content-area py-1">
            <div class="container-fluid">
                <div class=" bg-white table-responsive">
                    <!--
                    <div class="form-group col-md-3 col-lg-3 col-sm-6 col-xs-12" style="margin:1%">
                     <input type="text" name="search" class="form-control b-a" placeholder="Search for ..." id="search">
                   </div>
                   -->

                    <div class="form-group col-md-1 col-lg-1 col-sm-6 col-xs-12" style="margin:1%">
                        @if(Auth::guard('admin')->user()->hasPermissions(['Admin','add-log']))
                        <button type="button" class="btn btn-warning btn-rounded mb-0-25 waves-effect waves-light"
                                data-toggle="modal" data-target="#add_company"><b><i class="ti-plus"></i></b> Add
                        </button>
                        @endif
                    </div>
                    <div class="form-group col-md-2 col-lg-2 col-sm-3 col-xs-6" style="margin:1%">
                        <button type="button" class="excel btn btn-outline-warning mb-0-25 waves-effect waves-light">
                            <a href="{{url('/clearlog_excel')}}"> Export <i class="fa fa-file-excel-o"></i></a>
                        </button>
                    </div>

                    <div class="form-group col-md-1 col-lg-1 col-sm-2 col-xs-12" style="margin:1%;float: right;">
                        <select class="form-control" id="showEntry">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                            <option value="9000000">All</option>
                        </select>
                    </div>
                    <div class="site" id="user_data">
                        @include('admin.operation.clear-log.clear_log_table')
                    </div>
                </div>
                @stop
                @section('js')
                    <script type="text/javascript">
                        $(document).ready(function () {
                            // pagination section
                            $(document).on('click', '.pagination a', function (e) {
                                e.preventDefault();
                                var page = $(this).attr('href').split('page=')[1];
                                getMoreVehicle(page);

                                function getMoreVehicle(page) {
                                    $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '" + "{{asset('img/loading.gif')}}" + "' alt='Loading ...'> </div> ");
                                    var request = $.ajax({
                                        url: "{{route('paginate_clear_log_admin')}}" + '?page=' + page,
                                        method: "POST",
                                        data: {paginate: $("#showEntry").val()},
                                    });
                                    request.done(function (msg) {
                                        $('#user_data').html(msg);
                                    });
                                    request.fail(function (jqXHR, textStatus) {
                                        $('#user_data').html(textStatus);
                                    });
                                }
                            });

                            // search section
                            $('#search').on('keyup', function (e) {
                                var searchData = $(this).val();
                                searchclearlog(searchData);

                                function searchclearlog(searchData) {
                                    $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '" + "{{asset('img/loading.gif')}}" + "' alt='Loading ...'> </div> ");
                                    var request = $.ajax({
                                        url: "{{route('search_clear_log')}}",
                                        method: "GET",
                                        data: {searchValue: searchData},
                                    });
                                    request.done(function (msg) {
                                        $('#user_data').html(msg);
                                    });
                                    request.fail(function (jqXHR, textStatus) {
                                        $('#user_data').append(textStatus);
                                    });
                                }
                            });

                            // show entry section
                            $('#showEntry').change(function () {
                                $('#searchBody').html("<div style='position:fixed; margin-top:7%; margin-left:40%;'><img width='70px' src= '" + "{{asset('img/loading.gif')}}" + "' alt='Loading ...'> </div> ");
                                var data = $(this).val();
                                var request = $.ajax({
                                    url: "{{route('paginate_clear_log_admin')}}",
                                    method: "POST",
                                    data: {paginate: data},
                                });
                                request.done(function (msg) {
                                    $('#user_data').html(msg);
                                });
                                request.fail(function (jqXHR, textStatus) {
                                    $('#user_data').append(textStatus);
                                });
                            });

                            // $("#Experince").keyup(function (event) {
                            //     debugger
                            //
                            //     if ((event.which > 47
                            //         && event.which < 58) ||event.which== 190) {
                            //         if ($("#Experince").val().length > 3) {
                            //
                            //         }
                            //     } // prevent if not number/dot
                            //     else {
                            //         $("#Experince").val($("#Experince").val().slice(0, -1))
                            //     }
                            //
                            // });
                            // $.validator.addMethod("isFloatNumber", function (value, element) {
                            //     return this.optional(element) || /^\$(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/.test(value);
                            // }, "Please specify a valid amount");

                            // function isFloatNumber(item,evt) {
                            //     evt = (evt) ? evt : window.event;
                            //     var charCode = (evt.which) ? evt.which : evt.keyCode;
                            //     if (charCode==46)
                            //     {
                            //         var regex = new RegExp(/\./g)
                            //         var count = $(item).val().match(regex).length;
                            //         if (count > 1)
                            //         {
                            //             return false;
                            //         }
                            //     }
                            //     if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                            //         return false;
                            //     }
                            //     return true;
                            // }

                            var prevValue = "";
                            var patt = /^(\d*)([,.]\d{0,2})?$/;

                            function validateCurrencyPattern(price){
                                var matchedString = price.match(patt);
                                if (matchedString) {
                                    prevValue = matchedString[1] + (matchedString[2] ? matchedString[2].replace(",", ".") : "")
                                    return prevValue;
                                }
                                else {
                                    return prevValue;
                                }
                            }
                            $(document).on("keypress keyup blur paste","#field", function (event) {
                                $(this).val(validateCurrencyPattern($(this).val()));
                            });

                            // $(#number).keypress(function(event) {
                            //     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                            //         event.preventDefault();
                            //     }
                            // });

                            // make sortable table



                            $(document).ready(function() {
                            $('.js-example-basic-single').select2();
                        });
                        });
                    </script>
@stop
