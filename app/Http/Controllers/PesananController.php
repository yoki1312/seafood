<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('keranjang_temporary as ta')
            ->leftjoin('master_barang as tb', 'tb.id_barang','ta.id_barang')
            ->leftjoin('detail_transaksi as tc','tc.id_barang','tb.id_barang')
            ->leftjoin('admins as td','td.id','tb.id_supplier')
            ->select(DB::raw('sum(ta.qty) as qty, tb.*, sum(tc.qty) sisa_stock, td.name as nama_toko, ta.id_temporary'))
            ->where('ta.id_user', Auth::user()->id)
            ->groupBy('ta.id_barang')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = ' <a href="javascript:void(0)" data-id="'.$row->id_temporary.'" class=" btn btn-danger btn-sm btn-hapus-pesanan"><i class="fa fa-trash"></i></a>';
                           if($row->sisa_stock > 0){
                               $btn .= ' <a href="javascript:void(0)" class=" btn btn-success btn-cekout btn-sm">Cekout</a>';
                               $btn .= ' <a href="javascript:void(0)" class=" btn btn-info btn-un-cekout btn-sm" style="display:none">Batal</a>';

                           }
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('front.keranjang');
    }
    public function riwayatPesanan(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('transaksi as ta')
            ->leftjoin('detail_transaksi as tb','tb.id_transaksi','ta.id_transaksi')
            ->leftjoin('master_status_pembelian as tc', 'tc.id_status_pembelian', 'ta.id_status')
            ->select(DB::raw('ta.*,  sum(tb.qty) total_barang, tc.nama_status'))
            ->where('ta.id_user_pembeli', Auth::user()->id)
            ->groupBy('ta.id_transaksi')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = ' <a href="'. url('pesanan/detail/' . $row->id_transaksi) .'"  class=" btn btn-danger btn-sm btn-hapus-pesanan">Batal Pesanan</a>';
                           $btn .= ' <a href="'. url('pesanan/detail/' . $row->id_transaksi) .'"  class=" btn btn-success btn-cekout btn-sm">Bayar Pesanan</a>';
                        //    $btn .= ' <a href="javascript:void(0)" class=" btn btn-info btn-un-cekout btn-sm" style="display:none">Batal</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('front.cekout');
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
            $transaksi = [
                'id_user_pembeli' => Auth::user()->id,
                'id_jenis_transaksi' => 1,
                'id_status' => 1,
                'tanggal_transaksi' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'kode_transaksi'    => 'PEMBELIAN-'.date('Ymd').'(' . rand(10,100) .')'
            ];
            DB::table('transaksi')->insert($transaksi);
            $id_transaksi = DB::getPdo()->lastInsertId();
            
            $order = $request->detail_transaksi;
            foreach ($order as $key => $value) {
                $r = (object) $value;
                if($r->status_cekout == 1){
                    $keranjang = DB::table('keranjang_temporary')->where('id_temporary', $r->id_temporary)->first();
                    if($r->qty_pesanan < $keranjang->qty){
                        $qty = $keranjang->qty - $r->qty_pesanan;
                        DB::table('keranjang_temporary')->where('id_temporary', $r->id_temporary)->update(['qty' => $qty]);
                    }else{
                        DB::table('keranjang_temporary')->where('id_temporary', $r->id_temporary)->delete();
                    }
                    DB::table('detail_transaksi')->insert([
                        'id_transaksi' => $id_transaksi,
                        'qty' => $r->qty_pesanan * -1,
                        'id_barang' => $r->id_barang,
                        'harga' => str_replace(' ', '', $r->total_pesanan),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                
            }
            

            DB::commit();
            toastr()->success('Tambah Barang Berhasil', 'Berhasil');
            return redirect()->route('pesanan.index');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Simpan Barang '. $e->getMessage(), 'Gagal!');
            return redirect()->back();
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
        $data = DB::table('detail_transaksi as ta')
        ->leftjoin('master_barang as tb','tb.id_barang','ta.id_barang')
        ->select('ta.*','tb.nama_barang')
        ->where('ta.id_transaksi',$id)
        ->get();
        return view('front.detail-pesanan', compact('data'));
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
        DB::table('keranjang_temporary')->where('id_temporary', $id)->delete();
        return response()->json(
            [
              'success' => true,
              'message' => 'Data inserted successfully'
            ]
       );
    }
}
