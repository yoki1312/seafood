<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class BackEndPesananController extends Controller
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapuskomentarProduk($id)
    {
        DB::table('komentar_produk')->where('id_komentar', $id)->delete();
        return response()->json(
            [
              'status' => true,
              'message' => 'Data inserted successfully',
            ]
       );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getkomentarProduk($id)
    {
        $data = DB::table('komentar_produk as ta')
        ->leftjoin('users as tb', 'tb.id','ta.id_user')
        ->where('ta.id_barang', $id)
        ->get();
       
         return response()->json(
            [
              'status' => true,
              'message' => 'Data inserted successfully',
              'data'    => $data
            ]
       );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function komentarProduk(Request $request)
    {
        DB::table('komentar_produk')->insert([
            'id_barang' => $request->id_barang,
            'id_user'   => Auth::user()->id,
            'komentar'  => $request->komentar,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        return response()->json(
            [
              'status' => true,
              'message' => 'Data inserted successfully',
            ]
       );
    }
   
    public function tambahKeranjang(Request $request)
    {
        $cekOrderbarang = DB::table('keranjang_temporary')
        ->where('id_user', Auth::user()->id )
        ->where('id_barang', $request->id_barang)
        ->where('id_user', Auth::user()->id)
        ->groupBy('id_barang')
        ->select(DB::RAW('sum(qty) as qty_pesanan'))
        ->first();

        $cekStock = DB::table('detail_transaksi')
        ->where('id_barang',$request->id_barang)
        ->groupBy('id_barang')
        ->select(DB::RAW('sum(qty) as stock'))
        ->first();

        $totalPesanan = isset($cekOrderbarang->qty_pesanan) ? $cekOrderbarang->qty_pesanan + $request->qty : 0;
        $stock = isset($cekStock->stock) ? $cekStock->stock : 0;

        if($totalPesanan > $stock ){
            return response()->json(
                [
                  'status' => false,
                ]
           );
        }else{
            $cek_data = DB::table('keranjang_temporary')->where('id_barang', $request->id_barang)->where('id_user', Auth::user()->id)->count();
            if($cek_data == 0){
                DB::table('keranjang_temporary')->insert([
                    'id_barang' => $request->id_barang,
                    'qty' => $request->qty,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'id_user' => Auth::user()->id
                ]);
            }else{
                DB::table('keranjang_temporary')
                ->where('id_barang', $request->id_barang)
                ->where('id_user', Auth::user()->id)
                ->update([
                    'qty' => $totalPesanan,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            $newOrder = DB::table('keranjang_temporary')->select(DB::RAW('sum(qty) as pesanan'))->where('id_user', Auth::user()->id )->groupby('id_user')->first();
    
            return response()->json(
                [
                  'status' => true,
                  'message' => 'Data inserted successfully',
                  'totalData' => number_format($newOrder->pesanan,0)
                  ]
                );

        }
    }

    public function detailBarang($id){
        $data = DB::table('master_barang as ta')
        ->leftjoin('admins as tb', 'tb.id', 'ta.id_supplier')
        ->leftjoin('master_kategori_seafood as tc', 'tc.id_kategori_seafood','ta.id_kategori')
        ->leftJoin('detail_transaksi as ty', function($join) {
            $join->leftjoin('transaksi as tk', 'tk.id_transaksi','ty.id_transaksi')->on('ta.id_barang','ty.id_barang')->where('tk.id_status','!=',1);
          })
        ->leftJoin('detail_transaksi as tx', function($join) {
            $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->where('ti.id_status','!=',1);
          })
        ->where('ta.id_barang', $id)
        ->select(DB::RAW('sum(ty.qty) as stock, ta.*, tb.*, tc.*, sum(tx.qty) terjual'))
        ->groupby('ta.id_barang')
        ->first();

        $produkSerupa = DB::table('master_barang')->where('id_barang', '!=' , $id)->where('id_kategori', $data->id_kategori)->limit(4)->get();
        $file = DB::table('detail_barang')->where('id_barang', $id)->get();

        return view('front.detail_barang', compact('data','file','produkSerupa'));
    }
}
