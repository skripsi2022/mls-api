<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table nilai
        $nilai = Nilai::with('siswa')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Nilai',
            'data'    => $nilai
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'siswa_id'   => 'required',
            'nama_mapel' => 'required',
            'nilai' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $nilai = Nilai::create([
            'siswa_id'     => $request->siswa_id,
            'nama_mapel'   => $request->nama_mapel,
            'nilai'   => $request->nilai
        ]);

        if ($nilai) {
            return response()->json([
                'success' => true,
                'message' => 'Kelas Created',
                'data'    => $nilai
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Nilai Failed to Save',
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find nilai by ID
        $nilai = Nilai::with('siswa')->where('siswa_id',$id)->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Nilai',
            'data'    => $nilai
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'siswa_id'   => 'required',
            'mapel_id' => 'required',
            'nilai' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find nilai by ID
        $ujian = Nilai::findOrFail($nilai->id);

        if ($nilai) {

            // Update Ujian
            $nilai->update([
                'siswa_id'     => $request->siswa_id,
                'mapel_id'   => $request->mapel_id,
                'nilai'   => $request->nilai
            ]);

            return response()->json([
                'success' => true,
                'message' => 'kelas Updated',
                'data'    => $nilai
            ], 200);
        }

        //data nilai not found
        return response()->json([
            'success' => false,
            'message' => 'Nilai Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);

        try {
            $nilai->delete();
            $response = [
                'message' => 'Nilai Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    public function getSiswa($id){

        $nilai = Nilai::findOrfail($id);
        
        $nilai = Nilai::with('siswa','mapel')->where('siswa_id',$id)->get();

        return response()->json([
            'success' => 'true',
            'message' => 'data berhasil',
            'data_siswa' => $nilai
        ], 200);
    }
    public function getSiswaAll(){
        //get data from table nilai
        $nilai = Nilai::with('siswa','mapel')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Nilai',
            'data'    => $nilai
        ], 200);
    }
}
