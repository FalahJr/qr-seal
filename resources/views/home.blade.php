@extends('layouts.user.default')
@section('content')

    <div class="text-center">
        <h1 class="text-primary">Generate QR-CODE & Validasi </h1>
    </div>

    <div class="container container-body px-4">
        <div class="row gx-3">
            <div class="col-sm-6 text-center">
                <div class="row p-5 text-center display-flex">
                    <div class="card" style="height: 35rem">
                        <h5 class="card-title text-primary">Generate QR CODE</h5>
                        <img src="{{ asset('/img/Generate.png') }}" class="card-img-top" style="height: 30rem"
                            alt="Generate Qr-code">
                        <div class="card-body">
                            <a href="{{ route('generate-qr') }}" class="btn btn-primary" style="width: 70%">Upload</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row p-5 text-center">
                    <div class="card" style="height: 35rem">
                        <h5 class="card-title text-primary">Validasi File</h5>
                        <img src="{{ asset('/img/validasi.png') }}" class="card-img-top" style="height: 30rem"
                            alt="...">
                        <div class="card-body">
                            <a href="{{ route('scan') }}" class="btn btn-primary" style="width: 70% ">Upload</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
