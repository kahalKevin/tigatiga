@extends('layouts.app')

@section('content')

<div class="service-area" id="pages">
    <div class="container">
      <div class="row">
          <div class="col-12 text-white mt-150 mb-150">
              {!! $content !!}
          </div>
      </div>
    </div>
</div>
@endsection