<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class SettingAkunSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting_akun_supplier.index');
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
      
        $general = $request->general;
        $dataSupplier = $request->data_supplier;
        $general = (object)$general;
        $dataSupplier = (object)$dataSupplier;
        $oldData = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
        $fileName = $oldData->foto_profile;
        if($request->file('foto_profile')){
            $r = $request->file('foto_profile');
            $fileName = 'foto-'.time()."_". $general->nama;
            $r->move(public_path().'/foto-supplier', $fileName);

        }
        DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->update([
            'name' => $general->nama,
            'username'  => $general->username,
            'email' => $general->email,
            'password'  => empty($general->password) ? $oldData->password : Hash::make($general->password),
            'foto_profile'  => $fileName
        ]);

        DB::table('data_supplier')->where('id_supplier',Auth::guard('admin')->user()->id)->delete();
        DB::table('data_supplier')->insert([
            'nama_bank' => $dataSupplier->nama_bank,
            'no_rek'    => $dataSupplier->no_rek,
            'no_wa'  => $dataSupplier->nomor_wa,
            'kota'      => $dataSupplier->kota,
            'id_supplier'      => Auth::guard('admin')->user()->id,
            'alamat_lengkap'    => $dataSupplier->alamat_lengkap
        ]);

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
