@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col mt-5 mb-3">

        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            QR code
        </div>
        <div class="card-body">
            <div class="text-center">
               {!! file_get_contents('images/qrcode.svg') !!}
            </div>



        </div>
    </div>

@endsection


