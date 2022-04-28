<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table guru
        $guru = Guru::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Guru',
            'data'    => $guru
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
            'nama_guru'   => 'required',
            'alamat_guru' => 'required',
            'email_guru' => 'required|email',
            'notelp_guru' => 'required|numeric'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $user = User::create([
            "role" => "Guru",
            "name" => $request->nama_guru,
            "email" => $request->email_guru,
            "password" => Hash::make("password"),
        ]);

        $userID = DB::getPdo()->lastInsertId();

        $token = $user->createToken('auth_token')->plainTextToken;

        //save to database
        $ujian = Guru::create([
            'user_id' => $userID,
            'nama_guru'     => $request->nama_guru,
            'alamat_guru'   => $request->alamat_guru,
            'notelp_guru'   => $request->notelp_guru,
            'email_guru' => $request->email_guru,
        ]);

        if ($ujian) {
            return response()->json([
                'success' => true,
                'message' => 'Guru Created',
                'data'    => $ujian
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Guru Failed to Save',
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
        //find guru by ID
        $guru = Guru::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Guru',
            'data'    => $guru
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
            'nama_guru'   => 'required',
            'alamat_guru' => 'required',
            'notelp_guru' => 'required',
            'email_guru' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find guru by ID
        $guru = Guru::findOrFail($id);

        try {
            $guru->update($request->all());
            $response = [
                'message' => 'Guru Updated',
                'data' => $guru
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }

        //data guru not found
        return response()->json([
            'success' => false,
            'message' => 'Guru Not Found',
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
        // Find data Guru
        $guru = Guru::findOrFail($id);
        
        try {
            $guru->delete();
            // Find data Guru in users Table & Delete by Id
            $user = User::Where('id', $guru->user_id)->delete();
            //response success
            $response = [
                'message' => 'Guru Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {

            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
