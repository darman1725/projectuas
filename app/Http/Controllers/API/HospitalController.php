<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HospitalController extends Controller
{
    public function daftarHospital(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
    
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            };
            $data = Hospital::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
    public function jadwalHospital()
    {
        $data = Hospital::all();
        return response()->json($data);
    }

    public function destroy(Hospital $hospital) {
        $hospital->delete();
        return response()->json('Data berhasil dihapus');
    }
}
