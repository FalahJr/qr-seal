@extends('layouts.user.default')
@section('content')
    <div class="text-center py-5">
        <h1>Cek Validasi Sertifikat</h1>
    </div>
    <div class="container">
        <div class="row ">
            <form id="certificateForm" method="POST" action="{{ route('proses-qr') }}" enctype="multipart/form-data">
                <div class="col-xl-12">
                    <div class="card mb-4" style="border-radius: 10px;">
                        <div class="card-header" style="background-color: #40A2D8; border-radius: 10px">
                            <p class="text-start" style="color: white">INPUT INFORMASI SERTIFIKAT</p>
                        </div>
                        <div class="card-body">
                            <p class="text-start">Berikan Info Sertifikat Anda</p>
                            @csrf
                            <input type="file" id="fileInput" name="fileInput" style="display:none" accept=".pdf">
                            <div class="row mb-3">
                                <label for="serficate_number" class="col-md-2 col-form-label">No. Sertifikat</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="serficate_number" id="serficate_number"
                                        placeholder="13/X/2024" value="{{ $data->serficate_number }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label">Nama Peserta</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Gagah Perkasa" title="Masukkan Nama Lengkap"
                                        value="{{ $data->name }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jenis_pelatian" class="col-md-2 col-form-label">Jenis Pelatihan</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="jenis_pelatian" id="jenis_pelatian"
                                        placeholder="Pelatihan cocok tanam" value="{{ $data->jenis_pelatian }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_terbit" class="col-md-2 col-form-label">Tanggal Terbit</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control datepicker" name="date_terbit"
                                        id="date_terbit" value="{{ $data->date_terbit }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name_penandatangan" class="col-md-2 col-form-label">Penandatangan</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name_penandatangan"
                                        id="name_penandatangan" placeholder="" title="Nama yang Menandatangani"
                                        value="{{ $data->name_penandatangan }}" disabled>
                                </div>
                            </div>

                            <img src="{{ URL::asset('storage/' . $qr->path) }}" id="qrCode" alt="QR code"
                                style="width: 20%;">

                            {{-- <div class="form-group">
                            <label for="signatureCanvas">Tanda Tangan</label>
                            <canvas id="signatureCanvas" name="signatureCanvas" width="600" height="200"
                                style="border: 1px solid #40A2D8; border-radius: 5px;"></canvas>
                            <input type="hidden" id="signature" name="signature">
                        </div> --}}
                            {{-- <div class="form-group" style="margin-bottom: 20px;">
              <label for="uploadFile">Upload File</label>
              <input type="file" id="uploadFile" name="inputImage" style="border-radius: 5px; border: 1px solid #40A2D8;">
            </div> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
