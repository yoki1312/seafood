<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
class DaftarPembeliController extends Controller
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
            ->leftjoin('detail_transaksi as tb','tb.id_transaksi','ta.id_transaksi')
            ->leftjoin('master_barang as tc','tc.id_barang','tb.id_barang')
            ->leftjoin('users as td','td.id','ta.id_user_pembeli')
            ->select(DB::raw('count(ta.id_transaksi) as total_beli,sum(tb.harga) as total_harga, sum(abs(tb.qty)) as total_qty, td.name as nama_pembeli, ta.id_user_pembeli'));
            if(Auth::guard('admin')->user()->id == 0){
                $data->where('tc.id_supplier',Auth::guard('admin')->user()->id);
            }
            $data->where('ta.id_jenis_transaksi',1);
            $data->groupby('ta.id_user_pembeli');
            $data->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='';
                           $btn = '<button class="edit btn btn-primary btn-sm btn-open-modal-history">History Pembelian</button>';
                        //    $btn .= ' <a href="'. route('barang.edit',['id_barang' => $row->id_barang]) .'" class="edit btn btn-info btn-sm">Edit</a>';
                        //    $btn .= ' <a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                            return $btn;
                    })
                    // ->rawColumns(['action'])
                    ->addColumn('history', function($row){
                        $history = $this->historyPembelian($row->id_user_pembeli);
                        return json_decode($history);
                    })
                    ->rawColumns(['action','history'])
                    ->make(true);
        }
        return view('admin.daftar_pembeli.index');
    }

    function historyPembelian($id_user){
        $data = DB::table('detail_transaksi as ta')
        ->leftjoin('transaksi as tb','tb.id_transaksi','ta.id_transaksi')
        ->leftjoin('master_barang as tc','tc.id_barang','ta.id_barang')
        ->select(DB::raw('sum(ta.qty) as total_qty,sum(ta.harga) as total_harga,tb.kode_transaksi ,tb.tanggal_transaksi'))
        ->where('tb.id_jenis_transaksi',1)
        ->where('tb.id_user_pembeli', $id_user);
        if(Auth::guard('admin')->user()->id == 0){
            $data->where('tc.id_supplier',Auth::guard('admin')->user()->id);
        }
        $data->where('tb.id_status',2);
        $data->groupby('tb.id_transaksi');
        $data->get();

        $sql = $data;
        // dd($data);
        return $sql->get();
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
        //
    }
}
