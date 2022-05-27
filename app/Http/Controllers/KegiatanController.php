<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kegiatan::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data Kegiatan Pegawai',
            'data' => $data,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id_kegiatan" => ['required'],
            "nik" => ['required'],
            "nama_kegiatan" => ['required'],
            "asal_kegiatan" => ['required'],
            "target" => ['required'],
            "realisasi" => ['required'],
            "satuan" => ['required'],
            "batas_waktu" => ['required'],
            "tgl_realisasi" => ['required'],
            "keterangan" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $data = Kegiatan::create($request->all());

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kegiatan)
    {
        $data = Kegiatan::where('id_kegiatan', $id_kegiatan)->firstOrFail();
        if (is_null($data)) {
            return $this->sendError('Kegiatan tidak diemukan');
        }
        return response()->json([
            "success" => true,
            "message" => "Data ditemukan.",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kegiatan)
    {
        $data = Kegiatan::find($id_kegiatan);
        $data->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data telah diubah.",
            "data" => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kegiatan)
    {
        $data = Kegiatan::where('id_kegiatan', $id_kegiatan)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data berhasil dihapus.",
            "data" => $data,
        ]);
    }
}
