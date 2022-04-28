<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table soal
        $soal = Soal::with('ujian')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Soal',
            'data'    => $soal
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
            'ujian_id'   => 'required',
            'isi_soal' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_benar' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $soal = Soal::create([
            'ujian_id'     => $request->ujian_id,
            'isi_soal'   => $request->isi_soal,
            'opsi_a'   => $request->opsi_a,
            'opsi_b'   => $request->opsi_b,
            'opsi_c'   => $request->opsi_c,
            'opsi_d'   => $request->opsi_d,
            'opsi_benar'   => $request->opsi_benar,
        ]);

        if ($soal) {
            return response()->json([
                'success' => true,
                'message' => 'Soal Created',
                'data'    => $soal
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Soal Failed to Save',
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
        //find soal by ID
        $soal = Soal::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Soal',
            'data'    => $soal
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
    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'ujian_id'   => 'required',
            'isi_soal' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_benar' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find ujian by ID
        $soal = Soal::findOrFail($id);

        if ($soal) {
            // Update Ujian
            $soal->update([
                'ujian_id'     => $request->ujian_id,
                'isi_soal'   => $request->isi_soal,
                'opsi_a'   => $request->opsi_a,
                'opsi_b'   => $request->opsi_b,
                'opsi_c'   => $request->opsi_c,
                'opsi_d'   => $request->opsi_d,
                'opsi_benar'   => $request->opsi_benar,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Soal Updated',
                'data'    => $soal
            ], 200);
        }

        //data soal not found
        return response()->json([
            'success' => false,
            'message' => 'soal Not Found',
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
        $soal = Soal::findOrFail($id);

        try {
            $soal->delete();
            $response = [
                'message' => 'Soal Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
    
    public function getSoalByUjian($id){

        //find Soal by ID
        $soal = Soal::with('ujian')->where('ujian_id', $id)->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data siswa',
            'data'    => $soal
        ], 200);
    }
}
