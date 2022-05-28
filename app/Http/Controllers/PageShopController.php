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
        ->leftJoin('detail_transaksi as ty', function($join) {
            $join->leftjoin('transaksi as tk', 'tk.id_transaksi','ty.id_transaksi')->on('ta.id_barang','ty.id_barang')->where('tk.id_status','!=',1);
          })
        ->leftJoin('detail_transaksi as tx', function($join) {
            $join->leftjoin('transaksi as ti', 'ti.id_transaksi','tx.id_transaksi')->on('ta.id_barang','tx.id_barang')->where('ti.id_jenis_transaksi',1)->where('ti.id_status','!=',1);
          })
        ->select(DB::RAW('sum(ty.qty) as stock, ta.*, tb.name, tc.nama_kategori, sum(tx.qty) terjual'))
        ->groupby('ta.id_barang');
        if($request->sorting==2){
            $res->orderByRaw('sum(tx.qty) DESC');
        }else if($request->sorting==3){
            $res->orderByRaw('sum(ty.qty) DESC');
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
