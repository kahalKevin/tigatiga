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
            <a href="{{ url('/') }}/profile" class="text-red"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
            <hr>
            <a href="{{ url('/') }}/profile/order/history"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
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
                    <a data-toggle="modal" data-target="#modal-edit-address-{{ $address->id }}"><img src="./icon/writing@1x.png" alt=""></a>
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
                  <a href="{{ url('/') }}/profile/delete-address/{{ $address->id }}" class="cust-delete">Delete</a>
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
                <form class="form-horizontal" action="{{ url('/') }}/shop/add-new-address" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="label-form" for="receiver-name">Receiver Name</label>
                        <input class="form-control auth" type="text" name="receiver_name" value="" placeholder="Type your name">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="phone">Phone</label>
                        <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="provinsi">Province</label>
                        <select name="provinsi" id="provinsi" class="form-control auth provinsi">
                            <option value="">Select Province</option>
                            @foreach($province->rajaongkir->results as $prov)
                                <option value='{{ $prov->province_id }}'>{{ $prov->province }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label class="label-form" for="city">City or Distinct</label>
                        <div>
                            <select name="city" class="form-control auth city">
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="postal-code">Postal Code</label>
                        <input class="form-control auth" type="text" name="postal_code" value="" placeholder="Type your postal Code">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="address">Address</label>
                        <textarea class="form-control auth" name="address" rows="8" cols="80"></textarea>
                    </div>
                    <button class="btn btn-info btn-lg" type="submit" name="submit">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@foreach($addresses as $address)
  <div class="modal fade" id="modal-edit-address-{{ $address->id }}" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <p class="modal-title">Edit Address</p>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" action="{{ url('/') }}/profile/edit-address" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{ $address->id }}">
                      <div class="form-group">
                          <label class="label-form" for="receiver-name">Receiver Name</label>
                          <input class="form-control auth" type="text" name="receiver_name" value="{{ $address->_receiver_name }}" placeholder="Type your name">
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="phone">Phone</label>
                          <input class="form-control auth" type="text" name="phone" value="{{ $address->_receiver_phone }}" placeholder="+6281908xxxx">
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="provinsi">Province</label>
                          <select name="provinsi" class="form-control auth provinsi">
                              <option value="">Select Province</option>
                              @foreach($province->rajaongkir->results as $prov)
                                @if($prov->province_id == $address->ro_province_id)
                                  <option value='{{ $prov->province_id }}' selected>{{ $prov->province }}</option>
                                @else
                                  <option value='{{ $prov->province_id }}'>{{ $prov->province }}</option>
                                @endif
                              @endforeach
                          </select>
                      </div>                    
                      <div class="form-group">
                          <label class="label-form" for="city">City or Distinct</label>
                            <div>
                              <select name="city" class="form-control auth city">
                                @foreach($city["rajaongkir"]["results"] as $cit)
                                  @if($cit["city_id"] == $address->ro_city_id)
                                    <option value='{{ $cit["city_id"] }}' selected>{{ $cit["type"] . ' ' . $cit["city_name"] }}</option>
                                  @else
                                    <option value='{{ $cit["city_id"] }}'>{{ $cit["type"] . ' ' . $cit["city_name"] }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="postal-code">Postal Code</label>
                          <input class="form-control auth" type="text" name="postal_code" value="{{ $address->_kode_pos }}" placeholder="Type your postal Code">
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="address">Address</label>
                          <textarea class="form-control auth" name="address" rows="8" cols="80">{{ trim($address->_address) }}</textarea>
                      </div>
                      <button class="btn btn-info btn-lg" type="submit" name="submit">SAVE</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endforeach

@endsection