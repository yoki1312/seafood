<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\JenisTransaksi;
use DB;
use Auth;

class JenisTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = JenisTransaksi::all();
      if($request->ajax() ){
        return DataTables::of($transaksi)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm btn-edit">Edit</a> <a type="button"  class="delete btn btn-danger btn-sm btn-hapus">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
      }
        return view('admin.jenis_transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis_transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'jenis_transaksi' => 'required',
            ]);
            $jenis = JenisTransaksi::create($data);
            DB::commit();
            toastr()->success('Tambah Jenis Transaksi Berhasil', 'Berhasil');
            return redirect()->route('transaksi.index', $jenis);
            
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Simpan Kategori '. $e->getMessage(), 'Gagal!');
            return redirect()->back();
           
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
        $request->validate([
            'jenis_transaksi' => 'required',
            ]);
    
            JenisTransaksi::where('id_jenis_transaksi', $request->id)->update([
              'jenis_transaksi' => $request->jenis_transaksi
            ]);
            return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisTransaksi::where('id_jenis_transaksi',$id)->delete();
      return response()->json(['status' => 200]);
    }
}
