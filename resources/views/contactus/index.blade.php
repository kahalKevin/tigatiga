@extends('layouts.app')

@section('content')

<div class="service-area" id="pages">
    <div class="container">
      <div class="row mt-150 mb-150 text-white">
            @if(Session::has('status'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('status') }}
                    </div>
                </div>
            @endif   
          <div class="col-12">
              {!! $content !!}
          </div>
          <div class="col-6 mt-50">
            <form action="{{ url('/') }}/contactus" method="post">
                @csrf
                <div class="form-group">
                  <input name="_name" type="text" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <input name="_email" type="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <textarea name="_message" class="form-control" rows="3" placeholder="Message ..." required></textarea>
                </div>
                <button class="btn btn-submit-contactus">SUBMIT</button>
            </form>
          </div>
      </div>
    </div>
</div>
@endsection