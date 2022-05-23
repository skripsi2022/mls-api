<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'soal_id' => 'required',
            'user_id' => 'required',
            'isi_jawaban' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Cek Jawaban  Sebelum Store Ke Database
        $cekJawaban = Soal::where([
            ['id_soal','=', $request->soal_id],
            ['opsi_benar','=',$request->isi_jawaban]
        ])->first();

        if($cekJawaban){
            // Save Jawaban ke Database
            // $jawaban = Jawaban::create([
            //     'user_id' => $request->user_id,
            //     'soal_id' => $request->soal_id,
            //     'isi_soal' => $request->isi_soal,
            //     'isi_jawaban' => $request->isi_jawaban,
            //     'ket_jawaban' => "benar"
            // ]);
            return response()->json([
                'success' => true,
                'message' => 'Jawaban Benar',
                'data'    => $cekJawaban
            ], 201);
        }else{
            // Save Jawaban ke Database
            // $jawaban = Jawaban::create([
            //     'user_id' => $request->user_id,
            //     'soal_id' => $request->soal_id,
            //     'isi_soal' => $request->isi_soal,
            //     'isi_jawaban' => $request->isi_jawaban,
            //     'ket_jawaban' => "salah"
            // ]);
            return response()->json([
                'success' => true,
                'message' => 'Jawaban Salah',
                'data'    => $cekJawaban
            ], 201);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
