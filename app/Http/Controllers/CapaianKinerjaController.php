<?php

namespace App\Http\Controllers;

use App\Models\CapaianKinerja;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CapaianKinerjaController extends Controller
{
    public function index()
    {
        $data = CapaianKinerja::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data Capaian Kinerja',
            'data' => $data,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nik" => ['required'],
            "kategori" => ['required'],
            "periode" => ['required'],
            "detail_pekerjaan" => ['required'],
            "tgl_masuk" => ['required'],
            "catatan_operator" => ['required'],
            "nilai" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $data = CapaianKinerja::create($request->all());

            $response = [
                'message' => 'Berhasil disimpan',
                'data' => $data,
            ];

            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Gagal " . $e->errorInfo,
            ]);
        }
    }

    public function show($id_ckp)
    {
        $data = CapaianKinerja::where('id_ckp', $id_ckp)->firstOrFail();
        if (is_null($data)) {
            return $this->sendError('Data tidak diemukan');
        }
        return response()->json([
            "success" => true,
            "message" => "Data ditemukan.",
            "data" => $data,
        ]);
    }

    public function update(Request $request, $id_ckp)
    {
        $data = CapaianKinerja::find($id_ckp);
        $data->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data telah diubah.",
            "data" => $data,
        ]);
    }

    public function destroy($id_ckp)
    {
        $data = CapaianKinerja::where('id_ckp', $id_ckp)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data berhasil dihapus.",
            "data" => $data,
        ]);
    }

}
