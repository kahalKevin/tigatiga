@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="myprofile">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="box">
            <p class="mp-name">
              Hi, Dwi Putra Fath
            </p>
            <p class="mp-subname">
              lorem ipsum dolar sit amet
            </p>
            <a href="#"><span class="icon icon-User" style="padding-right: 13px;"></span>My Profile</a>
            <hr>
            <a href="#"><span class="icon icon-FullShoppingCart" style="padding-right: 13px;"></span>Order History</a>
            <hr>
            <a href="#"><span class="icon icon-ClosedLock" style="padding-right: 13px;"></span>Logout</a>
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
                    <p class="myaccount-right-side">Dwi</p>
                    <p class="myaccount-right-side">Putra Faturrahman</p>
                    <p class="myaccount-right-side">ipoet@gmail.com</p>
                    <p class="myaccount-right-side">089578555645</p>
                    <p class="myaccount-right-side">Male</p>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-change-password">CHANGE PASSWORD</button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Total Order</p>
                      <p class="value">18</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Total in Delivery</p>
                      <p class="value">9</p>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Total Received</p>
                      <p class="value">10</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="box-report">
                      <p class="title">Transaction Complete</p>
                      <p class="value">9</p>
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
            <div class="row" id="my-address">
              <div class="col-md-4">
                <div class="box" style="margin-top: 37px;">
                  <div class="edit-button">
                    <a href="#"><img src="./icon/writing@1x.png" alt=""></a>
                  </div>
                  <div class="cust-name">
                    Dwi Putra Faturrahman
                  </div>
                  <div class="cust-addr">
                    Kantor Codigo. Graha Mitra Lantai 7 Jl. Jend. Gatot Subroto Kav. 21
                  </div>
                  <div class="cust-phone">
                    08382381908
                  </div>
                  <a href="#" class="cust-delete">Delete</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box" style="margin-top: 37px; ">
                  <div class="edit-button">
                    <a href="#"><img src="./icon/writing@1x.png" alt=""></a>
                  </div>
                  <div class="cust-name">
                    Dwi Putra Faturrahman
                  </div>
                  <div class="cust-addr">
                    Jl. Sultan Agung Tirtayasa Gg. Pulomas III Rt. 02 Rw. 02 Ds. Kedawung
                  </div>
                  <div class="cust-phone">
                    08382381908
                  </div>
                  <a href="#" class="cust-delete">Delete</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box" style="margin-top: 37px;">
                  <div class="edit-button">
                    <a href="#"><img src="./icon/writing@1x.png" alt=""></a>
                  </div>
                  <div class="cust-name">
                      Dwi Putra Faturrahman
                  </div>
                  <div class="cust-addr">
                      Perumahan Bulak Kapal Permai Kel. Margahayu Kec. Bekasi Timur
                  </div>
                  <div class="cust-phone">
                      08382381908
                  </div>
                  <a href="#" class="cust-delete">Delete</a>
                </div>
              </div>
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