@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="reset-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form class="form-horizontal" action="{{ url('reset-password') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $token }}" name="token">
                <p class="rp-title">Reset Password</p>
                <div class="form-group">
                    <label class="label-form" for="new-password">New Password</label>
                    <input class="form-control auth" type="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    @if ($errors->has('password'))
                        <span class="" role="alert">
                            <strong><font color="red">{{ $errors->first('password') }}</font></strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="label-form" for="new-retype-password">New Re Type Password</label>
                    <input class="form-control auth" type="password" name="password_confirmation" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="" role="alert">
                            <strong><font color="red">{{ $errors->first('password_confirmation') }}</font></strong>
                        </span>
                    @endif
                </div>
                <input class="btn btn-info btn-lg" type="submit" name="submit" value="Submit">
            </form>
            </div>
        </div>
    </div>
</div>

@endsection