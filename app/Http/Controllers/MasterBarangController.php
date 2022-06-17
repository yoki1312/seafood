<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('master_barang as ta')
            ->leftjoin('detail_transaksi as tb', 'tb.id_barang','ta.id_barang')
            ->select(DB::raw('sum(tb.qty) as qty, ta.*'));
            if(Auth::guard('admin')->user()->is_super == 2){
                $data->where('id_supplier', Auth::guard('admin')->user()->id);
            }
             if($request->status_stok == 0){
                $data->havingRaw('sum(tb.qty) > 0');
            }
            if($request->status_stok == 1){
                $data->havingRaw('qty <= 0');
            }
            $data->groupBy('ta.id_barang');
            $data->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<button class="edit btn btn-primary btn-sm btn-modal-stok">Edit Stock</button>';
                           $btn .= ' <a href="'. route('barang.edit',['id_barang' => $row->id_barang]) .'" class="edit btn btn-info btn-sm">Edit</a>';
                           $btn .= ' <a href="'. route('barang.destroy',['id_barang' => $row->id_barang]) .'" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $totalBarang = DB::table('master_barang')->where('id_supplier', Auth::guard('admin')->user()->id)->count() + 1;
        $kodeBarang = "Barang-". str_pad($totalBarang,4,"0",STR_PAD_LEFT);
        $kategori = DB::table('master_kategori_seafood')->get();
        return view('admin.barang.add', compact('kodeBarang','kategori'));
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
            
            DB::table('master_barang')->insert([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_barang' => $request->harga_barang,
                'satuan_barang' => $request->satuan_barang,
                'harga_barang' => $request->harga_barang,
                'id_kategori' => $request->id_kategori,
                'id_supplier'   => Auth::guard('admin')->user()->id,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);

            $id_barang = DB::getPdo()->lastInsertId();
           
            foreach($request->file('file') as $item => $r){
                $fileName = time()."_". str_replace(' ' ,'_',$r->getClientOriginalName());
                $r->move(public_path().'/produk', $fileName);
                $data2=array(
                    'id_barang'=>$id_barang,
                    'file'=>$fileName,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                );
                if($item == 0){
                    DB::table('master_barang')->where('id_barang', $id_barang)->update([
                        'file_sampul' => $fileName
                    ]);
                }
                DB::table('detail_barang')->insert($data2);
            }
            DB::commit();
            toastr()->success('Tambah Barang Berhasil', 'Berhasil');
            return redirect()->route('barang.index');
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
        $data = DB::table('master_barang')->where('id_barang', $id)->first();
        $detail = DB::table('detail_barang')->where('id_barang', $id)->get();
        return view('admin.barang.edit', compact('data', 'detail'));

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
        DB::beginTransaction();
        $id = $request->id_barang;
        try {

            DB::table('master_barang')->where('id_barang', $id)->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_barang' => $request->harga_barang,
                'satuan_barang' => $request->satuan_barang,
                'harga_barang' => $request->harga_barang,
                'updated_at' => date('Y-m-d')
            ]);

            $id_barang = $id;
           
            if($request->file('file') != null){
                foreach($request->file('file') as $item=>$r){
                    $fileName = time()."_". str_replace(' ' ,'_',$r->getClientOriginalName());
                    $r->move(public_path().'/produk', $fileName);
                    $data2=array(
                        'id_barang'=>$id_barang,
                        'file'=>$fileName,
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d')
                    );
                    DB::table('detail_barang')->insert($data2);
                }
            }
           
            DB::commit();
            toastr()->success('Update Barang Berhasil', 'Berhasil');
            return redirect()->route('barang.index');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Update Barang '. $e->getMessage(), 'Gagal!');
            return redirect()->back();
            // something went wrong
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('master_barang')->where('id_barang', $id)->delete();
        DB::table('detail_transaksi')->where('id_barang', $id)->delete();
        return view('admin.barang.index');
    }

    public function tambahStock(Request $request){
        DB::table('transaksi')->insert([
            'id_user_pembeli' => 0,
            'id_jenis_transaksi' => 2,
            'id_supplier' => Auth::guard('admin')->user()->id,
            'kode_transaksi' => 'TAMBAH_QTY_'.rand(10,1000),
            'tanggal_transaksi' => date('Y-m-d'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
        $id_transaksi = DB::getPdo()->lastInsertId();

        DB::table('detail_transaksi')->insert([
            'id_barang' => $request->id_barang,
            'id_transaksi' => $id_transaksi,
            'qty' => $request->qty,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
        return response()->json(
            [
              'success' => true,
              'message' => 'Data inserted successfully'
            ]
       );
    }
}
