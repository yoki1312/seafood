<?php

function sliderKategori(){
    return \DB::table('master_kategori_seafood')->get();
}

function getProduk(){
    $data  =  DB::table('master_barang as ta')
    ->leftjoin('admins as tb', 'tb.id', 'ta.id_supplier')
    ->leftjoin('master_kategori_seafood as tc', 'tc.id_kategori_seafood','ta.id_kategori')
    ->leftJoin('detail_transaksi as ty', function($join) {
        $join->leftjoin('transaksi as tk', 'tk.id_transaksi','ty.id_transaksi')->on('ta.id_barang','ty.id_barang')->where('tk.id_status','!=',1);
      })
    ->leftJoin('detail_transaksi as tx', function($join) {
        $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->where('ti.id_status','!=',1);
      })
    ->select(DB::RAW('sum(ty.qty) as stock, ta.*, tb.name as nama_toko, tc.nama_kategori, sum(tx.qty) terjual'))
    ->groupby('ta.id_barang')
    ->orderByRaw('sum(tx.qty) DESC')
    ->limit(8)
    ->get();
    return $data;
}

function getKeranjang(){
    $id = Auth::user()->id;
    $data = DB::table('keranjang_temporary')->select(DB::RAW('sum(qty) as pesanan'))->where('id_user', $id )->groupby('id_user')->first();
    return isset($data->pesanan) ? number_format($data->pesanan,0) : 0;
}