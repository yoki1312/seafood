<?php

namespace App\Http\Controllers;

use App\Models\SettingPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view("admin.setting_pengiriman.index");
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
        SettingPengiriman::truncate();
        SettingPengiriman::insert([
            'harga_luar'  => $request->harga_luar,
            'harga_dalam'  => $request->harga_dalam, 
        ]);
        toastr()->success('Setting pengiriman Berhasil', 'Berhasil');
        return redirect('setting-pengiriman');
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

    public function ref_kabupaten(Request $request){
        $data = DB::table('indonesia_cities')->whereIn('id',[251,252,250,264]);
        if( !empty($request->term) ){
            $data->where('name', 'LIKE', "%{$request->term}%");
        }
        $data->limit(10)->get();
        $data = $data->get();
        return \Response::json($data);
    }

    public function ref_kecamatan(Request $request){
        $data = DB::table('indonesia_districts')->whereIn('id', [3790,3796,3798,3801]);
        if( !empty($request->term) ){
            $data->where('name', 'LIKE', "%{$request->term}%");
        }
        $data->limit(10)->get();
        $data = $data->get();
        return \Response::json($data);
    }

    public function ref_desa(Request $request){
        $data = DB::table('indonesia_villages')->where('district_code', $request->kode_kecamatan);
        if( !empty($request->term) ){
            $data->where('name', 'LIKE', "%{$request->term}%");
        }
        $data->limit(10)->get();
        $data = $data->get();
        return \Response::json($data);
    }
}
