<?php

function sliderKategori(){
    return \DB::table('master_kategori_seafood')->get();
}

function printJSON($v){
  header('Access-Control-Allow-Origin: *');
  header("Content-type: application/json");
  echo json_encode($v, JSON_PRETTY_PRINT);
  exit;
}

function getProduk(){
    $data  =  DB::table('master_barang as ta')
    ->leftjoin('admins as tb', 'tb.id', 'ta.id_supplier')
    ->leftjoin('master_kategori_seafood as tc', 'tc.id_kategori_seafood','ta.id_kategori')
    ->leftJoin(DB::raw('(select sum(ta.qty) as qty_stock, ta.id_barang from detail_transaksi ta INNER JOIN transaksi tc on tc.id_transaksi = ta.id_transaksi where tc.id_status in (0,2,4) GROUP BY ta.id_barang) tz'), function($join){
      $join->on('tz.id_barang' ,'=' ,'ta.id_barang');
  })
    ->leftJoin('detail_transaksi as tx', function($join) {
        $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->whereIn('ti.id_status',[0,2,4]);
      })
    ->select(DB::RAW('tz.qty_stock as stock, ta.*, tb.name as nama_toko, tc.nama_kategori, sum(tx.qty) terjual'))
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

function sessionSupplier(){
  $id = Auth::guard('admin')->user()->id;
  return DB::table('data_supplier')->where('id_supplier', $id)->first();
}

function getBarangSupplier(){
  $id = Auth::guard('admin')->user()->id;
  $data = DB::table('master_barang')->where('id_supplier',$id)->count();
  return $data;
}
function getContackUs(){
  $data = DB::table('master_contact_us')->first();
  return $data;
}
function getGambarDashboard(){
  $data = DB::table('gambar_dashboard')->first();
  return $data;
}

function dataDashboard() {
  $k = new \stdClass();
  $k->total_user = DB::table('users')->count();
  $k->total_supplier = DB::table('data_supplier')->count();
  $k->total_transaksi = DB::table('data_transaksi')->count();
  $k->total_barang = DB::table('master_barang')->count();
  return $k;
}