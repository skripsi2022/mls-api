<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table siswa
        $siswa = Siswa::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Siswa',
            'data'    => $siswa
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
            'nama_siswa' => ['required'],
            'nis_siswa' => ['required'],
            'kelas_id' => ['required'],
            'alamat_siswa' => ['required'],
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            "role" => "Siswa",
            "name" => $request->nama_siswa,
            "email" => $request->nis_siswa . "@student.mlscloud.id",
            "password" => Hash::make($request->nis_siswa),
        ]);

        $userID = DB::getPdo()->lastInsertId();
        
        $siswa = Siswa::create([
            "user_id" => $userID,
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'nis_siswa' => $request->nis_siswa,
            'alamat_siswa' => $request->alamat_siswa,
        ]);

        if($siswa){

            return response()->json([
                'success' => true,
                'message' => 'Kelas Created',
                'data'    => $siswa
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
        //find siswa by ID
        $siswa = Siswa::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Siswa',
            'data'    => $siswa
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
    public function update(Request $request, Siswa $siswa)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_siswa'   => 'required',
            'user_id' => 'required',
            'kelas_id' => 'required',
            'nama_siswa' => 'required',
            'nis_siswa' => 'required',
            'alamat_siswa' => 'required',
        ]);

        //find siswa by ID
        $siswa = Siswa::findOrFail($siswa->id);

        if($siswa){
            // update siswa

            $siswa->update([
                'nama_siswa'   => $request->nama_siswa,
                'user_id' => $request->user_id,
                'kelas_id' => $request->kelas_id,
                'nama_siswa' => $request->nama_siswa,
                'nis_siswa' => $request->nis_siswa,
                'alamat_siswa' => $request->alamat_siswa,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'siswa Updated',
                'data'    => $siswa
            ], 200);
        }

        //data siswa not found
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
        //find siswa by ID
        $siswa = Siswa::findOrFail($id);

        if($siswa){

            //delete Siswa
            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Siswa Deleted',
            ], 200);

        }

        //data Siswa not found
        return response()->json([
            'success' => false,
            'message' => 'Siswa Not Found',
        ], 404);

    }
}
