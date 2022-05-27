<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cuti::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data Cuti Pegawai',
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
            "nik" => ['required'],
            "tgl_pengajuan" => ['required'],
            "tgl_mulai_cuti" => ['required'],
            "tgl_selesai_cuti" => ['required'],
            "alasan_cuti" => ['required'],
            "status" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $data = Cuti::create($request->all());

            $response = [
                'message' => 'Data Berhasil Disimpan',
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
    public function show($id_permintaan_cuti)
    {
        $data = Cuti::where('id_permintaan_cuti', $id_permintaan_cuti)->firstOrFail();
        if (is_null($data)) {
            return $this->sendError('Data Tidak ditemukan');
        }
        return response()->json([
            "success" => true,
            "message" => "Data Ditemukan",
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
    public function update(Request $request, $id_permintaan_cuti)
    {
        $data = Cuti::find($id_permintaan_cuti);
        $data->update($request->all());        
        return response()->json([
            "success" => true,
            "message" => "Data Telah Diubah",
            "data" => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_permintaan_cuti)
    {
        $data = Cuti::where('id_permintaan_cuti', $id_permintaan_cuti)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data Berhasil Dihapus",
            "data" => $data,
        ]);
    }
}
