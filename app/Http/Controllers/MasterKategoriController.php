<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
class MasterKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('master_kategori_seafood')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = ' <a href="'. route('kategori.edit',['id_kategori' => $row->id_kategori_seafood]) .'" class="edit btn btn-info btn-sm">Edit</a>';
                           $btn .= ' <a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.kategori_seafood.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('admin.kategori_seafood.add');
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
            
            $r = $request->file('file');
            $fileName = time()."_". str_replace(' ' ,'_',$r->getClientOriginalName());
            $r->move(public_path().'/kategori-image', $fileName);

            DB::table('master_kategori_seafood')->insert([
                'nama_kategori' => $request->nama_kategori,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'gambar_kategori'=>$fileName,
            ]);

           
            DB::commit();
            toastr()->success('Tambah Kategori Berhasil', 'Berhasil');
            return redirect()->route('kategori.index');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Simpan Kategori '. $e->getMessage(), 'Gagal!');
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
        $data = DB::table('master_kategori_seafood')->where('id_kategori_seafood', $id)->first();
        return view('admin.kategori_seafood.edit', compact('data'));

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
        $id = $request->id_kategori_seafood;
        try {
            $fileName = '';
            if($request->file('file') != null){
                $r = $request->file('file');
                $fileName = time()."_". str_replace(' ' ,'_',$r->getClientOriginalName());
                $r->move(public_path().'/kategori-image', $fileName);
            }else{
                $data = DB::table('master_kategori_seafood')->where('id_kategori_seafood', $id)->first();
                $fileName = $data->gambar_kategori;
            }
            DB::table('master_kategori_seafood')->where('id_kategori_seafood', $id)->update([
                'nama_kategori' => $request->nama_kategori,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'gambar_kategori'=>$fileName,
            ]);
            DB::commit();
            toastr()->success('Update Kategori Berhasil', 'Berhasil');
            return redirect()->route('kategori.index');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Update Kategori '. $e->getMessage(), 'Gagal!');
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
        //
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
