<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table Mapel
        $mapel = Mapel::with('guru')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Kelas',
            'data'    => $mapel
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
            'nama_mapel'   => 'required',
            'guru_id' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $mapel = Mapel::create([
            'nama_mapel'     => $request->nama_mapel,
            'guru_id'   => $request->guru_id
        ]);

        //success save to database
        if ($mapel) {

            return response()->json([
                'success' => true,
                'message' => 'Mapel Created',
                'data'    => $mapel
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kelas Failed to Save',
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
        //find mapel by ID
        $mapel = Mapel::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Mapel',
            'data'    => $mapel
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
    public function update(Request $request,$id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_mapel'   => 'required',
            'guru_id'   => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find mapel by ID
        $mapel = Mapel::findOrFail($id);

        try {
            $mapel->update($request->all());
            $response = [
                'message' => 'Mapel Updated',
                'data' => $mapel
            ];

            return response()->json($response,
                Response::HTTP_OK
            );
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);

        try {
            $mapel->delete();
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
    // get mapel by guru id 
    public function getMapelGuru(Request $request)
    {
        // find guru by ID user
        $guru = Guru::where([
            ['user_id','=', $request->id]
        ])->first();

        $mapel = Mapel::where([
            ['guru_id', '=', $guru->id_guru]
        ])->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data mapel',
            'data'    => $mapel
        ], 200);
    }
}
