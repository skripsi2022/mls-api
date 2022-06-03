<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Siswa;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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
        //get data from table ujian
        $ujian = Jawaban::latest()->get();

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
        // find siswa by ID user
        $siswa = Siswa::where([
            ['user_id', '=', $request->siswa_id]
        ])->first();

        if($siswa){
            $validator = Validator::make($request->all(), [
                'soal_id' => 'required',
                'siswa_id' => 'required',
                'ujian_id' => 'required',
                'isi_jawaban' => 'required',
                'opsi_jawaban' => 'required'
            ]);

            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            // Cek Jawaban  Sebelum Store Ke Database
            $cekJawaban = Soal::where([
                ['id_soal', '=', $request->soal_id],
                ['opsi_benar', '=', $request->opsi_jawaban]
            ])->first();

            if ($cekJawaban) {
                // Save Jawaban ke Database
                $jawaban = Jawaban::create([
                    'siswa_id' => $siswa->id_siswa,
                    'ujian_id' => $request->ujian_id,
                    'soal_id' => $request->soal_id,
                    'isi_soal' => $request->isi_soal,
                    'isi_jawaban' => $request->isi_jawaban,
                    'opsi_jawaban' => $request->opsi_jawaban,
                    'ket_jawaban' => "benar"
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Jawaban Benar',
                    'data'    => $jawaban
                ], 201);
            } else {
                // Save Jawaban ke Database
                $jawaban = Jawaban::create([
                    'siswa_id' => $siswa->id_siswa,
                    'ujian_id' => $request->ujian_id,
                    'soal_id' => $request->soal_id,
                    'isi_soal' => $request->isi_soal,
                    'isi_jawaban' => $request->isi_jawaban,
                    'opsi_jawaban' => $request->opsi_jawaban,
                    'ket_jawaban' => "salah"
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Jawaban Salah',
                    'data'    => $jawaban
                ], 201);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Hayo Error',
            ], 400);
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
        //Validasi 
        $validator = Validator::make($request->all(), [
            'soal_id' => 'required',
            'siswa_id' => 'required',
            'ujian_id' => 'required',
            'isi_jawaban' => 'required',
            'opsi_jawaban' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Cari Jawaban by ID
        $jawaban = Jawaban::findOrFail($id);

        if($jawaban){
            // find siswa by ID user
            $siswa = Siswa::where([
                ['user_id', '=', $request->siswa_id]
            ])->first();
            
            // Cek Jawaban  Sebelum Update Ke Database
            $cekJawaban = Soal::where([
                ['id_soal', '=', $request->soal_id],
                ['opsi_benar', '=', $request->opsi_jawaban]
            ])->first();

            // Update Jawaban
            if($cekJawaban){
                $jawaban->update([
                'siswa_id' => $siswa->id_siswa,
                'soal_id' => $request->soal_id,
                'ujian_id' => $request->ujian_id,
                'isi_soal' => $request->isi_soal,
                'isi_jawaban' => $request->isi_jawaban,
                'opsi_jawaban' => $request->opsi_jawaban,
                'ket_jawaban' => "benar"
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Jawaban Benar',
                    'data'    => $jawaban
                ], 201);
            }else{
                $jawaban->update([
                    'siswa_id' => $siswa->id_siswa,
                    'soal_id' => $request->soal_id,
                    'ujian_id' => $request->ujian_id,
                    'isi_soal' => $request->isi_soal,
                    'isi_jawaban' => $request->isi_jawaban,
                    'opsi_jawaban' => $request->opsi_jawaban,
                    'ket_jawaban' => "salah"
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Jawaban Salah',
                    'data'    => $jawaban
                ], 201);
            }
        }

        //data jawaban not found
        return response()->json([
            'success' => false,
            'message' => 'Jawaban Tidak Ada',
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
        //
    }
    

    //check jawaban by id 
    public function cekJawaban(Request $request){

        // find siswa by ID user
        $siswa = Siswa::where([
            ['user_id', '=', $request->user_id]
        ])->first();

        $cekJawaban = Jawaban::where([
            ['siswa_id', '=', $siswa->id_siswa],
            ['ujian_id', '=', $request->ujian_id],
            ['soal_id', '=', $request->soal_id],
        ])->first();
        
        if($cekJawaban){
            return response()->json([
                'success' => true,
                'message' => 'Anda Sudah Jawab kampang',
                'data' => $cekJawaban
            ], 200);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Anda Belum Jawab kampang',
                'data' => $cekJawaban
            ], 200);
        }

    }

}
