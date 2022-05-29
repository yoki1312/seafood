<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PageShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = DB::table('master_barang as ta')
        ->leftjoin('admins as tb', 'tb.id', 'ta.id_supplier')
        ->leftjoin('master_kategori_seafood as tc', 'tc.id_kategori_seafood','ta.id_kategori')
        ->leftJoin(DB::raw('(select sum(ta.qty) as qty_stock, ta.id_barang from detail_transaksi ta INNER JOIN transaksi tc on tc.id_transaksi = ta.id_transaksi where tc.id_status in (0,2) GROUP BY ta.id_barang) tz'), function($join){
            $join->on('tz.id_barang' ,'=' ,'ta.id_barang');
        })
        ->leftJoin('detail_transaksi as tx', function($join) {
            $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->whereIn('ti.id_status',[0,2]);
          })
        ->select(DB::RAW('tz.qty_stock as stock, ta.*, tb.name, tc.nama_kategori, sum(tx.qty) terjual'));
        if($request->id_kategori != 0){
            $res->where('ta.id_kategori', $request->id_kategori);
        }
        $res->groupby('ta.id_barang');
        if($request->sorting==2){
            $res->orderByRaw('sum(tx.qty) DESC');
        }else if($request->sorting==3){
            $res->orderByRaw('tz.qty_stock DESC');
        }else{
            $res->orderby('ta.created_at', 'desc');
        }

        $res->get();
        $data = $res->paginate(8);
        // dd($data['total']);
        $total_data = DB::table('master_barang')->count();
        if($request->ajax()){
            return view('front.child_shop',compact('data', 'total_data'))->render();
        }
        return view('front.shop',compact('data', 'total_data'));
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
