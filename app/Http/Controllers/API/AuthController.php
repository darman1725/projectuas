<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPenggunaRequest;
use App\Models\Kasus;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registerPengguna(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'no_telp' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            };
            $data = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'role' => 'mhs',
                'username' => $request->username,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
            ]);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            };
            $data = User::where('username', $request->username)->first();
            if (!$data) {
                return response()->json(['errors' => 'Data tidak ditemukan']);
            }

            if (Hash::check($request->password, $data->password)) {
                return response()->json($data);
            }

            return response()->json(['errors' => 'Password salah']);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function editPassword(Request $request, $id)
    {
        $data = User::find($id);
        $data->password = Hash::make($request->password);
        $hasil = $data->save();
        // if ($hasil) {
        //     return ['hasil' => "data update"];
        // } else {
        //     return ['hasil' => "data belum update"];
        // }
        return response()->json($hasil);
    }
    public function singleUser($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }
}
