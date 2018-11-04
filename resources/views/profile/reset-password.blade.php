@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="reset-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form class="form-horizontal" action="index.html" method="post">
                <p class="rp-title">Reset Password</p>
                <div class="form-group">
                    <label class="label-form" for="new-password">New Password</label>
                    <input class="form-control auth" type="password" name="new-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>
                <div class="form-group">
                    <label class="label-form" for="new-retype-password">New Re Type Password</label>
                    <input class="form-control auth" type="password" name="new-retype-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>
                <input class="btn btn-info btn-lg" type="submit" name="submit" value="Submit">
            </form>
            </div>
        </div>
    </div>
</div>

@endsection