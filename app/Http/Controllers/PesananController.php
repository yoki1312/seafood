<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
use App\Events\StatusLiked;

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
            ->leftJoin(DB::raw('(select sum(ta.qty) as qty_stock, ta.id_barang from detail_transaksi ta INNER JOIN transaksi tc on tc.id_transaksi = ta.id_transaksi where tc.id_status in (0,2,4) GROUP BY ta.id_barang) tz'), function($join){
                $join->on('tz.id_barang' ,'=' ,'ta.id_barang');
            })
            ->leftJoin('detail_transaksi as tx', function($join) {
                $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->whereIn('ti.id_status',[0,2,4]);
              })
            ->leftjoin('admins as td','td.id','tb.id_supplier')
            ->select(DB::raw('ta.qty, tb.*, tz.qty_stock sisa_stock, td.name as nama_toko, ta.id_temporary'))
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
            ->leftjoin('data_transaksi as td', 'td.id_transaksi', 'ta.id_transaksi')
            ->select(DB::raw('ta.*,  sum(tb.qty) total_barang, tc.nama_status, td.file'))
            ->where('ta.id_user_pembeli', Auth::user()->id)
            ->groupBy('ta.id_transaksi')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn ='';
                        if($row->id_status == 1){
                               $btn .= ' <button type="button" data-id="'. $row->id_transaksi .'" class=" btn btn-danger btn-sm btn-hapus-pesanan">Batal Pesanan</button>';
                               $btn .= ' <a href="'. url('pesanan/detail/' . $row->id_transaksi) .'"  class=" btn btn-info btn-cekout btn-sm">Bayar Pesanan</a>';
                        }else{
                            $btn .= ' <a href="'. url('pesanan/detail/' . $row->id_transaksi) .'"  class=" btn btn-success btn-cekout btn-sm">Detail Pesanan</a>';    
                        }
                        if($row->id_status == 2){
                            $btn .= ' <button type="button" data-id-transaksi="'. $row->id_transaksi .'"  class=" btn btn-secondary btn-terima-pesanan btn-sm">Terima Pesanan</button>';
                        }
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
        // printJSON($request->all());
        DB::beginTransaction();

        try {
            $transaksi = [
                'id_user_pembeli' => Auth::user()->id,
                'id_jenis_transaksi' => 1,
                'id_status' => 1,
                'tanggal_transaksi' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'kode_transaksi'    => 'PEMBELIAN-'.date('Ymd').'(' . rand(10,100) .')',
                'id_kecamatan' => $request->id_kecamatan,
                'id_desa' => $request->id_desa,
                'ongkir'    => $request->ongkir,
                'alamat'    => $request->alamat
            ];
            // printJSON($transaksi);
            DB::table('transaksi')->insert($transaksi);
            $id_transaksi = DB::getPdo()->lastInsertId();
            
            DB::table('data_transaksi')->insert([
                'id_transaksi' => $id_transaksi,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'id_kecamatan' => $request->id_kecamatan,
                'id_desa' => $request->id_desa,
                'ongkir'    => $request->ongkir,
                'alamat_lengkap'    => $request->alamat
            ]);

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
                        'harga' => str_replace(',', '', $r->total_pesanan),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                
            }
            

            DB::commit();
            toastr()->success('Tambah Barang Berhasil', 'Berhasil');
            return redirect('pesanan/detail/'.$id_transaksi);
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
        $header = DB::table('transaksi')->where('id_transaksi', $id)->first();
        $dataTransaksi = DB::table('data_transaksi')->where('id_transaksi', $id)->first();
        return view('front.detail-pesanan', compact('data','header','dataTransaksi'));
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
    public function update(Request $request)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', $request->id_transaksi)->first();
        $datatransaksi = DB::table('data_transaksi')->where('id_transaksi', $request->id_transaksi)->first();
        
        $fileName = $datatransaksi->file;
        if($request->file('file')){
            $r = $request->file('file');
            $fileName = 'pembayaran-'.time()."_". $transaksi->kode_transaksi;
            $r->move(public_path().'/file-pembayaran', $fileName);

        }

        DB::table('transaksi')->where('id_transaksi', $request->id_transaksi)->update([
            'id_status' => 3
        ]);

        DB::table('data_transaksi')->where('id_transaksi', $request->id_transaksi)->update([
            'nama' => $request->nama_depan .' '. $request->nama_belakang,
            'kota' => '',
            'email' => Auth::user()->email, 
            'catatan' => $request->catatan,
            'nomor_hp' => $request->nomor_hp,
            'file'  => $fileName
        ]);
        
        $data = DB::table('transaksi')
        ->leftjoin('users', 'users.id', 'transaksi.id_user_pembeli')
        ->where('id_status',3)->get();
        event(new StatusLiked($data));
        \Mail::to(getContackUs()->email_center)->send(new \App\Mail\KonfirmasiPenjualan(array(
            'title' => 'Konfirmasi Pembayaran Pesanan',
            'body' => Auth::user()->name . ' melakukan pembayaran atas transaksi '.$transaksi->kode_transaksi . ' silahkan cek pada menu laporan penjualan',
            'bukti_pembayaran' => $fileName,
            'button' => url('laporan_penjualan/acc_pembayaran/'. $request->id_transaksi),
            'text_button'   => 'Setujui Pembayaran'
        )));
        toastr()->success('pembayaran berhasil, dan admin segera melakukan konfirmasi pembayaran', 'Berhasil!');
        return redirect('/');
        // dd($request->all());
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
    public function destroyTransaksi($id)
    {
        DB::table('transaksi')->where('id_transaksi', $id)->delete();
        DB::table('detail_transaksi')->where('id_transaksi', $id)->delete();
        return response()->json(
            [
              'success' => true,
              'message' => 'Data inserted successfully'
            ]
       );
    }
    public function terimaPensanan(Request $request){
        DB::table('transaksi')->where('id_transaksi',$request->id_transaksi)->update([
            'id_status'=> 4,
            'rating'=> $request->rating,
            'note_penerima' => $request->keterangan,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        $getTransaksi = DB::table('detail_transaksi as ty')
        ->leftjoin('transaksi as tj','tj.id_transaksi', 'ty.id_transaksi')
        ->leftjoin('master_barang as tz', 'tz.id_barang','ty.id_barang')
        ->leftjoin('admins as tu', 'tu.id','tz.id_supplier')
        ->select('tu.email','tz.nama_barang','tz.id_barang','tj.kode_transaksi')
        ->where('ty.id_transaksi', $request->id_transaksi)
        ->get();
        foreach($getTransaksi as $s){
            $cek = DB::table('komentar_produk')->where('id_barang', $s->id_barang)->insert([
                'id_barang' => $s->id_barang,
                'id_user' => Auth::user()->id,
                'komentar'  => $request->keterangan,
                'rating'    => $request->rating,
                'updated_at'    => date('Y-m-d H:i:s'),
                'created_at'    => date('Y-m-d H:i:s')
            ]);
            \Mail::to(getContackUs()->email_center)->send(new \App\Mail\KonfirmasiPenjualan(array(
                'title' => 'Konfirmasi pembelian',
                'body' => 'Transaksi '.$s->kode_transaksi. ' Barang '. $s->nama_barang .' sudah diterima oleh pembeli'  
            )));
            \Mail::to($s->email)->send(new \App\Mail\KonfirmasiPenjualan(array(
                'title' => 'Konfirmasi pembelian',
                'body' => 'Transaksi '.$s->kode_transaksi. ' Barang '. $s->nama_barang .' sudah diterima oleh pembeli'  
            )));
        }
        
        toastr()->success('Status pesanan berhasil diperbarui', 'Berhasil!');
        return view('front.cekout');
    }
}
