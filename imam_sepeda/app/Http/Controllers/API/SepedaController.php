<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\SepedaResource;
use App\Models\Sepeda;

class SepedaController extends Controller
{
    //
    public function index()
    {
        $data_awal = Sepeda::with('merk')->get();
        $data = SepedaResource::collection($data_awal);
        // $data = Sepeda::all();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Sepeda::with('merk')->where('id', $id)->first();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|min:10',
            'merk_id' => 'required|integer'
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $data = Sepeda::create($request->all());
        return response()->json([
            'pesan' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }

    public function sewa(Request $request, $id)
    {
        $data = Sepeda::where('id', $id)->first();
        $validate = Validator::make($request->all(),[
            'disewakan' => 'required|integer'
        ]);
        if ($validate->fails()){
            return $validate->errors();
        }
        $data->update($request->all());
        return response()->json([
            'pesan' => 'Data berhasil di update',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = Sepeda::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|min:10',
            'merk_id' => 'required|integer'
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
        $data = Sepeda::where('id', $id)->first();
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
