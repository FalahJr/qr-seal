<?php

namespace App\Http\Controllers;

use App\Models\GenareteQRFile;
use App\Models\GenerateQR;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index($id)
    {
        $filesQR = GenareteQRFile::where('generate_qr_id', $id)->where('type', 'qr')->first();
        $filesSertif = GenareteQRFile::where('generate_qr_id', $id)->where('type', 'file')->first();

        $data = GenerateQR::where('id', $id)->first();

        return view('validasi', [
            'data' => $data,
            'file' => $filesSertif,
            'qr' => $filesQR
        ]);
    }
}
