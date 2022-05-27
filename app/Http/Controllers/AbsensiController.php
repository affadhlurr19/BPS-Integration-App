<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Absensi::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data Absensi',
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
            "tanggal" => ['required'],
            "jam_masuk" => ['required'],
            "jam_pulang" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $data = Absensi::create($request->all());

            $response = [
                'message' => 'Data Berhasil disimpan',
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
    public function show($id_absensi)
    {
        $data = Absensi::where('id_absensi', $id_absensi)->firstOrFail();
        if (is_null($data)) {
            return $this->sendError('Data tidak diemukan');
        }
        return response()->json([
            "success" => true,
            "message" => "Data Absen ditemukan.",
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
    public function update(Request $request, $id_absensi)
    {
        $data = Absensi::find($id_absensi);
        $data->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data Absen telah diubah.",
            "data" => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_absensi)
    {
        $data = Absensi::where('id_absensi', $id_absensi)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data Absen berhasil dihapus.",
            "data" => $data,
        ]);
    }
}
