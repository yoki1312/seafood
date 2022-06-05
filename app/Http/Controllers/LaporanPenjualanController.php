<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('transaksi as ta')
            ->leftjoin('users as tb', 'tb.id','ta.id_user_pembeli')
            ->leftjoin('master_status_pembelian as tc', 'tc.id_status_pembelian','ta.id_status')
            ->leftjoin('detail_transaksi as td','td.id_transaksi','ta.id_transaksi')
            ->leftjoin('master_barang as te','te.id_barang','td.id_barang')
            ->select(DB::raw('ta.id_transaksi, ta.kode_transaksi,ta.tanggal_transaksi,tb.name as nama_pembeli,tc.nama_status'));
            if(Auth::guard('admin')->user()->is_super == 2){
                $data->where('te.id_supplier',  Auth::guard('admin')->user()->id);
            }
            $data->where('ta.id_jenis_transaksi', 1);
            $data->groupby('ta.id_transaksi');
            $data->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='';
                           $btn = '<a href="'. route('laporan_penjualan.detail',['id_transaksi' => $row->id_transaksi]) .'" class="edit btn btn-primary btn-sm">Detail Transaksi</a>';
                        //    $btn .= ' <a href="'. route('barang.edit',['id_barang' => $row->id_barang]) .'" class="edit btn btn-info btn-sm">Edit</a>';
                        //    $btn .= ' <a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.laporan_penjualan.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $header = DB::table('transaksi as ta')
        ->leftjoin('users as tb', 'tb.id','ta.id_user_pembeli')
        ->leftjoin('master_status_pembelian as tc', 'tc.id_status_pembelian','ta.id_status')
        ->select(DB::raw('ta.id_transaksi,tb.name as nama_pembeli,tc.nama_status, ta.created_at,ta.*'))
        ->where('ta.id_transaksi', $id)
        ->groupBy('ta.kode_transaksi')
        ->first();
        
        $data_transaksi = DB::table('data_transaksi as ta')->where('ta.id_transaksi', $id)
        ->first();

        $sql = DB::table('transaksi as ta')
        ->leftjoin('detail_transaksi as tb','tb.id_transaksi','ta.id_transaksi')
        ->leftjoin('users as tc','tc.id','ta.id_user_pembeli')
        ->leftjoin('master_barang as td','td.id_barang','tb.id_barang')
        ->leftjoin('master_status_pembelian as tf','tf.id_status_pembelian','ta.id_status')
        ->leftjoin('admins as tg', 'tg.id', 'td.id_supplier')
        ->select('ta.id_transaksi','tb.harga','tb.qty','ta.kode_transaksi','ta.tanggal_transaksi','tc.name as nama_pembeli','td.*','tg.name as nama_toko')
        ->where('ta.id_transaksi', $id);
        if(Auth::guard('admin')->user()->is_super == 2){
            $sql->where('td.id_supplier',  Auth::guard('admin')->user()->id);
        }
        $data = $sql->get();
        return view('admin.laporan_penjualan.detail', compact('header','data','data_transaksi'));
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
    public function acc_pembayaran($id)
    {
        DB::table('transaksi')->where('id_transaksi', $id)->update([
            'id_status' => 2
        ]);

        return redirect()->back();
    }
}
