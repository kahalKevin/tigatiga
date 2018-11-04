@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order-tracking">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="header">
                    <p class="title">Order Tracking</p>
                    <p class="sub-title">Track your order history here</p><br>
                    <form class="form-horizontal" action="/" method="post">
                        <input type="text" name="order-id" class="form-control auth" placeholder="Order Id">
                        <input type="submit" name="submit" class="btn btn-info" value="VIEW DETAIL">
                    </form>
                    <hr>
                </div>
                <div class="tracking-table">
                    <p class="tracking-details">Tracking Details</p>
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>No. AWS</th>
                                    <th>Services</th>
                                    <th>Date of Shipment</th>
                                    <th>Orgin</th>
                                    <th>Destination</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09899896756</td>
                                    <td>REG</td>
                                    <td>07 Des 2017 14:00</td>
                                    <td>JAKARTA</td>
                                    <td>BANDUNG</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Shipper</th>
                                    <th>Consignee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PT. Superstore</td>
                                    <td>Dedi Iswadi</td>
                                </tr>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>Bandung</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class="table-content">
                        <table>
                            <tbody>
                                <tr>
                                    <td>09 Des 2017 13:00</td>
                                    <td>GATEWAY JAKARTA</td>
                                    <td>On Transit</td>
                                </tr>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>JAKARTA</td>
                                    <td>Manifasted</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection