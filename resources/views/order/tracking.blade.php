@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="order-tracking">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="header">
                    <p class="title">Order Tracking</p>
                    <p class="sub-title">Track your order history here</p><br>
                    <form class="form-horizontal" action="/shop/tracking-order" method="get">
                        <input type="text" name="order_id" value="" class="form-control auth" placeholder="Order Id">
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
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['waybill_number'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['service_code'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['details']['waybill_date'] }} {{ $status_delivery['rajaongkir']['result']['details']['waybill_time'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['details']['origin'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['details']['destination'] }}</td>
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
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['shipper_name'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['receiver_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['origin'] }}</td>
                                    <td>{{ $status_delivery['rajaongkir']['result']['summary']['destination'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class="table-content">
                        <table>
                            <tbody>
                                @foreach($status_delivery['rajaongkir']['result']['manifest'] as $prov)
                                    <option value='{{ $prov->province_id }}'>{{ $prov->province }}</option>
                                @endforeach
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