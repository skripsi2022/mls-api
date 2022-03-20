<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $mapel = Mapel::latest()->get();

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
    public function update(Request $request, Mapel $mapel)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_kelas'   => 'required',
            'jurusan_id'   => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find mapel by ID
        $mapel = Mapel::findOrFail($mapel->id);

        if ($mapel) {

            //update kelas
            $mapel->update([
                'nama_kelas'     => $request->nama_mapel,
                'guru_id'     => $request->guru_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'mapel Updated',
                'data'    => $mapel
            ], 200);
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
        //
    }
}
