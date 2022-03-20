<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table admin
        $admin = Admin::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Admin',
            'data'    => $admin
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
            'nama_admin'   => 'required',
            'user_id' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $admin = Admin::create([
            'nama_admin'     => $request->nama_admin,
            'user_id'   => $request->user_id,
        ]);

        if ($admin) {
            return response()->json([
                'success' => true,
                'message' => 'Admin Created',
                'data'    => $admin
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Admin Failed to Save',
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
        //find admin by ID
        $admin = Admin::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Admin',
            'data'    => $admin
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
    public function update(Request $request, Admin $admin)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_admin'   => 'required',
            'user_id' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find admin by ID
        $admin = Admin::findOrFail($admin->id);

        if ($admin) {

            // Update Ujian
            $admin->update([
                'nama_admin'     => $request->nama_admin,
                'user_id'       => $request->user_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'admin Updated',
                'data'    => $admin
            ], 200);
        }

        //data admin not found
        return response()->json([
            'success' => false,
            'message' => 'Admin Not Found',
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
        $admin = Admin::findOrFail($id);

        try {
            $admin->delete();
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
}
