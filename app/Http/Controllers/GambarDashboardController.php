<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class GambarDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting_dashboard.index');
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
     
        $id = getGambarDashboard();
        $gambar_utama = (object)$request->gambar_utama;
        
        if(!empty($gambar_utama->file)){
            $file = $gambar_utama->file;
            $fileNama = time()."_". str_replace(' ' ,'_',$file->getClientOriginalName());
            $file->move(public_path().'/gambar-dashboard', $fileNama);
        }
        if(!empty($gambar_utama->gambar_t1)){
            $gambar_t1 = $gambar_utama->gambar_t1;
            $fileNamagambar_t1 = time()."_". str_replace(' ' ,'_',$gambar_t1->getClientOriginalName());
            $gambar_t1->move(public_path().'/gambar-dashboard', $fileNamagambar_t1);
        }
        if(!empty($gambar_utama->gambar_t2)){
            $gambar_t2 = $gambar_utama->gambar_t2;
            $fileNamagambar_t2 = time()."_". str_replace(' ' ,'_',$gambar_t2->getClientOriginalName());
            $gambar_t2->move(public_path().'/gambar-dashboard', $fileNamagambar_t2);
        }

        DB::table('gambar_dashboard')->insert([
            'id_jenis_kontent' => 1,
            'gambar'  => isset($fileNama) ? $fileNama : $id->gambar,
            'gambar_t1'  => isset($fileNamagambar_t1) ? $fileNamagambar_t1 : $id->gambar_t1,
            'gambar_t2'  => isset($fileNamagambar_t2) ? $fileNamagambar_t2 : $id->gambar_t2,
            'judul' => $gambar_utama->judul,
            'caption' => $gambar_utama->caption,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $id = DB::getPdo()->lastInsertId();

        DB::table('gambar_dashboard')->where('id' , '!=', $id)->delete();

        toastr()->success('Berhasil diperbarui', 'Berhasil');
        return redirect()->back();
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
