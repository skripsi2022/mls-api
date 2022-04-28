<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table kelass
        $kelas = Kelas::with('jurusan')->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Kelas',
            'data'    => $kelas
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
            'nama_kelas'   => 'required',
            'jurusan_id' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $kelas = Kelas::create([
            'nama_kelas'     => $request->nama_kelas,
            'jurusan_id'   => $request->jurusan_id
        ]);

        //success save to database
        if ($kelas) {

            return response()->json([
                'success' => true,
                'message' => 'Kelas Created',
                'data'    => $kelas
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
        //find kelas by ID
        $kelas = Kelas::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Kelas',
            'data'    => $kelas
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
            'nama_kelas'   => 'required',
            'jurusan_id'   => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find kelas by ID
        $kelas = Kelas::findOrFail($id);

        if ($kelas) {

            //update kelas
            $kelas->update([
                'nama_kelas'     => $request->nama_kelas,
                'jurusan_id'     => $request->jurusan_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'kelas Updated',
                'data'    => $kelas
            ], 200);
        }

        //data kelas not found
        return response()->json([
            'success' => false,
            'message' => 'kelas Not Found',
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
        //find Kelas by ID
        $kelas = Kelas::findOrfail($id);

        if($kelas) {

            //delete Kelas
            $kelas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kelas Deleted',
            ], 200);

        }

        //data Kelas not found
        return response()->json([
            'success' => false,
            'message' => 'Kelas Not Found',
        ], 404);
    }

}
