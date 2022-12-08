<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contact_us.index');
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

        
        DB::beginTransaction();

        try {
            if(isset($request->gambar)){
                $r = $request->file('gambar');
                $fileName = 'foto-'.time()."_". $request->judul;
                $r->move(public_path().'/foto-contact-us', $fileName);

            }
            DB::table('master_contact_us')->delete();
            DB::table('master_contact_us')->where('id_contact_us','!=',null)->insert([
                'judul' => $request->judul,
                'no_rekening' => $request->no_rekening,
                'nama_rekening' => $request->nama_rekening,
                'nama_bank' => $request->nama_bank,
                'keterangan'  => $request->keterangan,
                'email_center'  => $request->email_center,
                'alamat_center'  => $request->alamat_center,
                'telp_center'  => $request->telp_center,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
            if(isset($request->gambar)){
                DB::table('master_contact_us')->where('id_contact_us','!=',null)->update([
                    'gambar' => $fileName,
                ]);
            }
            DB::commit();
            return redirect()->back();
        // all good
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            // something went wrong
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
