<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

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
            'rating'    => $request->rating,
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
        ->leftJoin(DB::raw('(select sum(ta.qty) as qty_stock, ta.id_barang from detail_transaksi ta INNER JOIN transaksi tc on tc.id_transaksi = ta.id_transaksi where tc.id_status in (0,2,4) GROUP BY ta.id_barang) tz'), function($join){
            $join->on('tz.id_barang' ,'=' ,'ta.id_barang');
        })
        ->leftJoin('detail_transaksi as tx', function($join) {
            $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','=','tx.id_barang')->where('ti.id_jenis_transaksi',1)->whereIn('ti.id_status',[0,2,4]);
          })
        ->where('ta.id_barang', $id)
        ->select(DB::RAW('tz.qty_stock as stock, ta.*, tb.*, tc.*, sum(tx.qty) terjual'))
        ->groupby('ta.id_barang')
        ->first();

        $produkSerupa = DB::table('master_barang')->where('id_barang', '!=' , $id)->where('id_kategori', $data->id_kategori)->limit(4)->get();
        $file = DB::table('detail_barang')->where('id_barang', $id)->get();

        return view('front.detail_barang', compact('data','file','produkSerupa'));
    }

    public function hitungOngkir(Request $request)
    {
        
        $dataAwal = DB::table('setting_pengiriman')->first();
        if( empty($request->id_desa)){
            return 0;
        }
        
        $desaAwal = DB::table('indonesia_villages')->where('id', $dataAwal->id_desa)->first();
        $lokasiAwal = json_decode($desaAwal->meta);
        $lon1 = $lokasiAwal->long;
        $lat1 = $lokasiAwal->lat;
        
        $desaTujuan = DB::table('indonesia_villages')->where('id', $request->id_desa)->first();
        $lokasiTujuan = json_decode($desaTujuan->meta);
        $lon2 = $lokasiTujuan->long;
        $lat2 = $lokasiTujuan->lat; 

        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters * $dataAwal->harga_meter;
    }
}
