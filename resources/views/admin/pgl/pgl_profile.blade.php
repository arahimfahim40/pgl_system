@extends('admin.layout.main')
@section('title','Pgl Profile')
@section('style')
<style type="text/css">
    h6{
        padding-bottom:20px !important ;
    }
    label{
        font-weight: bold;
    }

</style>

@stop
@section('content')
<div class="site-content">
  <div class="content-area">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover" style="background-image: url(img/photos-1/1.jpg);">
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="card profile-card">
                    <div class="profile-avatar">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </div>
                    <div class="card-block">
                        <h4 class="mb-0-25">PGL</h4>
                        <div class="text-muted mb-1">Peace Global Logistics</div>
                    </div>
                    <ul class="list-group">
                        <a class="list-group-item" href="#">
                            <i class="fa fa-envelope mr-0-5"></i> {{@$comp_profile->email}}
                        </a>
                        <a class="list-group-item" href="#">
                            <i class="ti-world mr-0-5"></i> {{@$comp_profile->street}}
                        </a>
                        <a class="list-group-item" href="{{@$comp_profile->facebook}}" target="_blank">
                            <i class="ti-facebook mr-0-5"></i> {{@$comp_profile->facebook}}
                        </a>
                    </ul>
                </div>
                <div class="box bg-info mb-0">
                    <div class="box-block">
                        <div class="media">
                            <div class="media-left">
                                <div class="avatar box-48">
                                    <img class="b-a-radius-circle" src="img/avatars/4.jpg" alt="">
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading mt-0-5"><a class="text-white mr-1" href="#">PGL</a></h6>
                                <div class="font-90 mb-0-5"> Peace Global Logistics</div>
                                @if(Auth::guard('admin')->user()->hasPermissions(['Admin','edit-company']))
                                <a href="#update" data-toggle="modal" class="btn btn-outline-white btn-rounded">Update</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#stream" role="tab"><b>Profile Info</b></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="stream" role="tabpanel">
                            <div class="media stream-item">
                                <div class="media-left">
                                    <div class="avatar box-64">
                                        <img class="b-a-radius-circle" src="img/avatars/5.jpg" alt="">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#">Name</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->name}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Street Address</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->street}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL City</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->city}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL State</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->state}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL Zip Code</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->zip_code}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Email</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->email}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#">  Phone</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->phone}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL Fax</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->fax}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL Website</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->website}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> PGL Facebook</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->facebook}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank Name</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->bank_name}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Acount Name</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->account_name}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank Account Number</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->account_number}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> ABA Rounting</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->aba}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> SWIFT Code</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->swift}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank Street Address</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->b_street}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank City</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->b_city}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank State</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->b_state}}</span>
                                    </h6>
                                     <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank Zip Code</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->b_zip}}</span>
                                    </h6>
                                    <h6 class="media-heading">
                                        <a class="text-black col-md-4 col-lg-4" href="#"> Bank Country</a>
                                        <span class="font-100 col-md-8 col-lg-8">{{$comp_profile->b_country}}</span>
                                    </h6>
                                    
                                </div>
                            </div>
                            <div class="media stream-item">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>	
@include('admin.pgl.update_profile')	
@stop

