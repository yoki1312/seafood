<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use DataTables;
use DB;
use Auth;
class PesananPerbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('detail_transaksi as ta')
            ->join('master_barang as tb', 'tb.id_barang','ta.id_barang')
            ->join('transaksi as tc','tc.id_transaksi','ta.id_transaksi')
            ->select(DB::raw('sum(abs(ta.qty)) as total_qty, sum(ta.harga) as total_harga, tc.kode_transaksi,tc.tanggal_transaksi,tb.*'))
            ->where('tc.id_status',2)
            ->where('tc.id_jenis_transaksi',1);
            if(Auth::guard('admin')->user()->id == 0){
                $data->where('tb.id_supplier',  Auth::guard('admin')->user()->id);
            }
            $data->groupBy('ta.id_barang');
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
                    ->rawColumns(['action'])
                    ->addColumn('history', function($row){
                        $history = $this->historyPembelian($row->id_barang);
                        return json_decode($history);
                    })
                    ->rawColumns(['action','history'])
                    ->make(true);
        }
        return view('admin.laporan_perbarang.index');
    }

    function historyPembelian($id_barang){
        $data = DB::table('detail_transaksi as ta')
        ->join('transaksi as tb','tb.id_transaksi','ta.id_transaksi')
        ->join('users as tc','tc.id','tb.id_user_pembeli')
        ->select('ta.qty','ta.harga','tb.kode_transaksi','tb.tanggal_transaksi','tc.name as nama_pembeli')
        ->where('tb.id_status',2)
        ->where('tb.id_jenis_transaksi',1)
        ->where('ta.id_barang', $id_barang)
        ->get();
        return $data;
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
