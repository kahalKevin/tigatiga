@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="myprofile">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="box">
            <p class="mp-name">
              Hi, {{ Auth::user()->full_name }}
            </p>
            <a href="{{ url('/') }}/profile"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
            <hr>
            <a href="#"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
            <hr>
            <a href="{{ url('/') }}/logout"><span class="icon icon-ClosedLock" style="padding-right: 13px;"></span>Logout</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="row" id>
              <div class="col-md-8">
                <div class="myaccount-title">
                  <p>My Account</p>
                </div><br>
                <div class="row">
                  <div class="col-md-6">
                    <p class="myaccount-left-side">First Name</p>
                    <p class="myaccount-left-side">Last Name</p>
                    <p class="myaccount-left-side">Email</p>
                    <p class="myaccount-left-side">Phone</p>
                    <p class="myaccount-left-side">Gender</p>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-edit-profile">EDIT</button>
                  </div>
                  <div class="col-md-6">
                    <p class="myaccount-right-side">{{ Auth::user()->_first_name }}</p>
                    <p class="myaccount-right-side">{{ Auth::user()->_last_name }}</p>
                    <p class="myaccount-right-side">{{ Auth::user()->_email }}</p>
                    <p class="myaccount-right-side">{{ Auth::user()->_phone }}</p>
                    <p class="myaccount-right-side">
                      @php
                        if(Auth::user()->gender_id != null) {
                          echo Auth::user()->gender->_name;
                        } else {
                          echo "-";
                        }
                      @endphp
                    </p>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-change-password">CHANGE PASSWORD</button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-report">
                      <p class="title">Total Order</p>
                      <p class="value">{{ $total_order }}</p>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Total Received</p>
                      <p class="value">{{ $total_received }}</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Total in Delivery</p>
                      <p class="value">{{ $total_delivery }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="myaccount-title">
              <p>My Address</p>
            </div>
            <div class="row my-address">
            @foreach($addresses as $address)
              <div class="col-md-4">
                <div class="box" style="margin-top: 37px;">
                  <div class="edit-button">
                    <a href="#"><img src="./icon/writing@1x.png" alt=""></a>
                  </div>
                  <div class="cust-name">
                    {{ $address->_receiver_name }}
                  </div>
                  <div class="cust-addr">
                  {{ $address->_address }}
                  </div>
                  <div class="cust-phone">
                  {{ $address->_receiver_phone }}
                  </div>
                  <a href="#" class="cust-delete">Delete</a>
                </div>
              </div>
              @endforeach
              <div class="col-md-12" style="margin-top: 20px;">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-add-new-address">ADD NEW ADDRESS</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="modal-add-new-address" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title">Add New Address</p>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label class="label-form" for="receiver-name">Receiver Name</label>
                            <input class="form-control auth" type="text" name="receiver-name" value="" placeholder="Type your name">
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="phone">Phone</label>
                            <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="city-distinct">City or Distinct</label>
                            <input class="form-control auth" type="text" name="city-distinct" value="" placeholder="Search City or District">
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="postal-code">Postal Code</label>
                            <input class="form-control auth" type="text" name="postal-code" value="" placeholder="Type your postal Code">
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="address">Address</label>
                            <textarea class="form-control auth" name="address" rows="8" cols="80"></textarea>
                        </div>
                        <input class="btn btn-info btn-lg" type="submit" name="submit" value="SAVE">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection