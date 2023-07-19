<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\MerkResource;
use App\Models\Merk;

class MerkController extends Controller
{
    //
    public function index()
    {
        // $data_awal = Merk::with('sepedas')->get();
        // $data = MerkResource::collection($data_awal);
        $data_awal = Merk::all();
        $data = MerkResource::collection($data_awal);
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Merk::with('dealer')->where('id', $id)->first();
        // $data = Merk::with('merk')->where('id', $id)->first();

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'deskripsi' => 'required|min:10',
            'negara' => 'required|min:4',
            'dealer_id' => 'required|integer'
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $data = Merk::create($request->all());
        return response()->json([
            'pesan' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = Merk::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:5',
            'deskripsi' => 'required|min:10',
            'negara' => 'required|min:4',
            'dealer_id' => 'required|integer'
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
        $data = Merk::where('id', $id)->first();
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
