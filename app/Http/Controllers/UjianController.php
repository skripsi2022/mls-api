<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Ujian;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table ujian
        $ujian = Ujian::with('kelas','mapel')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Ujian',
            'data'    => $ujian
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
            'mapel_id'   => 'required',
            'kelas_id' => 'required',
            'nama_ujian' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $ujian = Ujian::create([
            'mapel_id'     => $request->mapel_id,
            'kelas_id'   => $request->kelas_id,
            'nama_ujian'   => $request->nama_ujian
        ]);

        if($ujian) {
            return response()->json([
                'success' => true,
                'message' => 'Kelas Created',
                'data'    => $ujian
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Ujian Failed to Save',
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
        //find ujian by ID
        $ujian = Ujian::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Ujian',
            'data'    => $ujian
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
            'mapel_id'   => 'required',
            'kelas_id' => 'required',
            'nama_ujian' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find ujian by ID
        $ujian = Ujian::findOrFail($id);

        if($ujian){
            // Update Ujian
            $ujian->update([
                'mapel_id'     => $request->mapel_id,
                'kelas_id'   => $request->kelas_id,
                'nama_ujian'   => $request->nama_ujian
            ]);

            return response()->json([
                'success' => true,
                'message' => 'kelas Updated',
                'data'    => $ujian
            ], 200);
        }

        //data ujian not found
        return response()->json([
            'success' => false,
            'message' => 'ujian Not Found',
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
        $ujian = Ujian::findOrFail($id);

        try {
            $ujian->delete();
            $response = [
                'message' => 'Ujian Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    // get Ujian by Siswa id 
    public function getUjianSiswa(Request $request)
    {
        // find siswa by ID user
        $siswa = Siswa::where([
            ['user_id', '=', $request->id]
        ])->first();

        $ujian = Ujian::where([
            ['kelas_id', '=', $siswa->kelas_id]
        ])->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Ujian mu',
            'data ujian'    => $ujian,
        ], 200);
    }
}
