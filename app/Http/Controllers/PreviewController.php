<?php

namespace App\Http\Controllers;

use App\Models\GenareteQRFile;
use Illuminate\Http\Request;
use PDF; // Import library untuk membaca PDF

class PreviewController extends Controller
{
    public function index(Request $request, $id)
    {
        $filesQR = GenareteQRFile::where('generate_qr_id', $id)->where('type', 'qr')->first();
        $filesSertif = GenareteQRFile::where('generate_qr_id', $id)->where('type', 'file')->first();
        // dd($filesSertif->path);
        // return dd($filesQR);
        $data = [
            'rsa' => $request->get('rsa'),
            'qr_code' => $filesQR->path,
            'file' => $filesSertif->path
        ];
        return view('preview', $data);
    }

    public function checkBarcode(Request $request)
    {
        $barcode = $request->input('barcode');

        $exists = GenareteQRFile::where('name', $barcode)->exists();

        return response()->json(['exists' => $exists]);
    }
}
