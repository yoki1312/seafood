<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::leftJoin(DB::raw('(select count(*) total_pembelian, id_user_pembeli from transaksi where id_status = 2 group by id_user_pembeli) tz'), function($join){
            $join->on('tz.id_user_pembeli' ,'=' ,'users.id');
        })
        ->select(DB::RAW('users.* , tz.total_pembelian'))
        ->groupby('users.id');
        if($request->ajax() ){
          return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                      $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm btn-edit">Edit</a> <a type="button"  class="delete btn btn-danger btn-sm btn-hapus">Delete</a>';
                      return $actionBtn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
        return view('admin.users.index');
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
