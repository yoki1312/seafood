<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use DB;
use Auth;
use Hash;
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
                    $actionBtn = '';
                    $actionBtn .= '<a href="'. route('akunUser.show',['id_user' => $row->id]) .'" class="edit btn btn-success btn-sm">Detail</a> ';
                    $actionBtn .= '<a href="'. route('akunUser.edit',['id_user' => $row->id]) .'" class="edit btn btn-info btn-sm">Edit</a> ';
                    $actionBtn .= '<a href="'. route('akunUser.destroy',['id_user' => $row->id]) .'" class="edit btn btn-danger btn-sm">Hapus</a> ';
                      return $actionBtn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
        return view('admin.akunUser.index');
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
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.akunUser.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.akunUser.edit', compact('data'));
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
        $data = DB::table('users')->where('id', $request->id_user)->first();
        $fileName = $data->foto_profile;
        if($request->file('file')){
            $r = $request->file('file');
            $fileName = 'foto-'.time()."_". str_replace(' ','_', $request->name);
            $r->move(public_path().'/foto-user', $fileName);
        }

        DB::table('users')->where('id', $request->id_user)->update([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
            'alamat' => $request->alamat,
            'foto_profile' => $fileName,
            'password' => !empty($request->password) ? Hash::make($request->password) : $data->password ,
        ]);
        toastr()->success('Akun berhasil di perbarui ', 'Berhasil!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        toastr()->success('Akun berhasil di hapus ', 'Berhasil!');
        return redirect()->back();
    }
}
