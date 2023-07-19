<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\DealerResource;
use App\Models\Dealer;

class DealerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $data = Dealer::all();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Dealer::where('id',$id)->first();
        return response()->json($data, 200);
    }



    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'no_hp' => 'required|min:5',
            'alamat' => 'required|min:10',
            'deskripsi' => 'required|min:10',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        // proses simpan data
        $data = Dealer::create($request->all());
        return response()->json([
            'pesan' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = Dealer::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'no_hp' => 'required|min:105',
            'alamat' => 'required|min:10',
            'deskripsi' => 'required|min:10',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $data->update($request->all());

        return response()->json([
            'pesan' => 'Data berhasil di update',
            'data' => $data
        ], 201);
    }
    public function destroy($id)
    {
        $data = Dealer::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $data->delete();

        return response()->json([
            'pesan' => 'Data berhasil di hapus',
            'data' => $data
        ], 200);
    }
}
