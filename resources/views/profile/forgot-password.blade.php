@extends('layouts.app')

@section('content')

<div class="service-area ptb-80" id="forgot-password">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <form class="form-horizontal" action="{{ url('forgot-password') }}" method="POST">
                    @csrf
                    <p class="fp-title">Forgot Password</p>
                    <p class="fp-caption">Tolong masukkan alamat email Anda. Kami akan kirim email <br>dengan instruksi untuk mengubah password Anda.</p>
                    <div class="form-group">
                        <label class="label-form" for="email">Email</label>
                        <input class="form-control auth" type="text" name="email" value="" placeholder="example@gmail.com" required>
                    </div>
                    <input class="btn btn-info btn-lg" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

