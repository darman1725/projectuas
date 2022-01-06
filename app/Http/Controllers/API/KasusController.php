<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kasus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KasusController extends Controller
{
    public function daftarKasus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'total_kasus' => 'required',
                'tanggal'  => 'required',
                'sembuh' => 'required',
                'meninggal' => 'required',
                'terkonfirmasi' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            };
            $data = Kasus::create([
                'total_kasus' => $request->total_kasus,
                'tanggal' => $request->tanggal,        
                'sembuh' => $request->sembuh,
                'meninggal' => $request->meninggal,
                'terkonfirmasi' => $request->terkonfirmasi,
            ]);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
    public function jadwalKasus()
    {
        $data = Kasus::all();
        return response()->json($data);
    }
    public function KasusFilterHariIni()
    {
        $tglSekarang = Carbon::now()->toDateString();
        $data = Kasus::where('tanggal', '=', $tglSekarang)->get();
        return response()->json($data);
    }
    
    public function destroy(Kasus $kasus) {
        $kasus->delete();
        return response()->json('Data berhasil dihapus');
    }
}
