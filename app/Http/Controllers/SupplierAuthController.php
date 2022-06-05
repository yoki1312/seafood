<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Hash;
use DataTables;
use DB;
use App\Mail\KonfirmasiPenjualan;
use Illuminate\Support\Facades\Mail;


class SupplierAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = "SELECT
        ta.*,
        count(tb.id_barang) as total_barang,
        IFNULL(tx.total_penjualan,0) total_penjualan
    FROM
        admins ta
        LEFT JOIN master_barang tb ON tb.id_supplier = ta.id 
        LEFT JOIN (select count(td.id_barang) as total_penjualan, td.id_supplier from transaksi ta inner join detail_transaksi tb on tb.id_transaksi = ta.id_transaksi LEFT JOIN master_barang td on td.id_barang = tb.id_barang where ta.id_status in (2,4) GROUP BY td.id_supplier ) tx on tx.id_supplier = ta.id
    WHERE ta.is_super != '1'
    GROUP BY
        ta.id";

        $data = DB::select($sql);

        if($request->ajax() ){
          return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                      $actionBtn = '';
                      $actionBtn .= '<a href="'. route('akunSupplier.show',['id_supplier' => $row->id]) .'" class="edit btn btn-success btn-sm">Detail</a> ';
                      $actionBtn .= '<a href="'. route('akunSupplier.edit',['id_supplier' => $row->id]) .'" class="edit btn btn-info btn-sm">Edit</a> ';
                      $actionBtn .= '<a href="'. route('akunSupplier.destroy',['id_supplier' => $row->id]) .'" class="edit btn btn-danger btn-sm">Hapus</a> ';
                      return $actionBtn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
        return view('admin.akunSupplier.index');
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
        $profile = DB::table('admins')->where('id', $id)->first();
        $data = DB::table('data_supplier')->where('id_supplier', $id)->first();
        return view('admin.akunSupplier.detail', compact('profile','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aktif($id)
    {
        DB::table('admins')->where('id', $id)->update([
            'status_aktif' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'tanggal_aktif' => date('Y-m-d'),
        ]);
        toastr()->success('Akun berhasil di aktifkan ', 'Berhasil!');
        return redirect()->back();
    }

    public function nonaktif($id)
    {
        DB::table('admins')->where('id', $id)->update([
            'status_aktif' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        toastr()->success('Akun berhasil di non aktifkan ', 'Berhasil!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $profile = DB::table('admins')->where('id', $id)->first();
        $data = DB::table('data_supplier')->where('id_supplier', $id)->first();
        return view('admin.akunSupplier.edit', compact('profile','data'));
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
        $general = $request->general;
        $dataSupplier = $request->data_supplier;
        $general = (object)$general;
        $dataSupplier = (object)$dataSupplier;

        $id_supplier = $general->id;
        $oldData = DB::table('admins')->where('id',$id_supplier)->first();
        $fileName = $oldData->foto_profile;
        if($request->file('foto_profile')){
            $r = $request->file('foto_profile');
            $fileName = 'foto-'.time()."_". $general->nama;
            $r->move(public_path().'/foto-supplier', $fileName);

        }
        DB::table('admins')->where('id',$id_supplier)->update([
            'name' => $general->nama,
            'username'  => $general->username,
            'email' => $general->email,
            'password'  => empty($general->password) ? $oldData->password : Hash::make($general->password),
            'foto_profile'  => $fileName
        ]);

        DB::table('data_supplier')->where('id_supplier',$id_supplier)->delete();
        DB::table('data_supplier')->insert([
            'nama_bank' => $dataSupplier->nama_bank,
            'no_rek'    => $dataSupplier->no_rek,
            'no_wa'  => $dataSupplier->nomor_wa,
            'kota'      => $dataSupplier->kota,
            'id_supplier'      => $id_supplier,
            'alamat_lengkap'    => $dataSupplier->alamat_lengkap
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
        $profile = DB::table('admins')->where('id', $id)->delete();
        $data = DB::table('data_supplier')->where('id_supplier', $id)->delete();
        toastr()->success('Akun berhasil di hapus ', 'Berhasil!');
        return redirect()->back();
    }
    
    
    public function register(Request $request)
    {
 
        $r = $request->file('file');
        $fileName = 'foto-supplier-'.time()."_". str_replace(' ','_',$request['nama_supplier']);
        $r->move(public_path().'/foto-supplier', $fileName);

        $admin = DB::table('admins')->insert([
            'name' => $request['nama_supplier'],
            'username' => $request['username'],
            'is_super' => 2,
            'foto_profile' => $fileName,
            'status_aktif' => 0,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $id_supplier = DB::getPdo()->lastInsertId();
        DB::table('data_supplier')->insert([
            'id_supplier' => $id_supplier,
            'alamat_lengkap' => $request['alamat'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // dd($admin->id);
        return redirect()->intended('login/supplier');
        
    }
    public function login(Request $request){
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $status_aktif = Auth::guard('admin')->user()->status_aktif;
            if($status_aktif == 0){
                Auth::guard('admin')->logout();
                toastr()->warning('Akun anda belum aktif ', 'Warning!');
                return redirect()->intended('login/supplier');
            }

            return redirect()->intended('/');
        }
        toastr()->error('Login Gagal, silahkan cek email dan password anda ', 'Gagal!');
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->intended('login/supplier');
    }

    public function tet(){

        // $details = [
        //     'title' => 'Mail from websitepercobaan.com',
        //     'body' => 'This is for testing email using smtp'
        // ];
       
        // \Mail::to('emailpenerima@gmail.com')->send(new \App\Mail\KonfirmasiPenjualan($details));
       
        // dd("Email sudah terkirim.");

        for ($i=1; $i <= 24 ; $i++) { 
            DB::table('master_barang')->insert([
                'kode_barang' => 'BARANG-'. $i,
                'nama_barang' => 'Kripik Ikan' . $i,
                'deskripsi_barang' => '',
                'harga_barang' => rand(5000,1200),
                'satuan_barang' => 'PACK',
                'id_kategori' => rand(1,3),
                'id_supplier'   => rand(1,3),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'file_sampul' => 'File_'.$i.'.jpeg'
            ]);
            $id_barang = DB::getPdo()->lastInsertId();

            $data = DB::table('master_barang')->where('id_barang', $id_barang)->first();
            DB::table('transaksi')->insert([
                'id_user_pembeli' => 0,
                'id_jenis_transaksi' => 2,
                'id_supplier' => $data->id_supplier,
                'kode_transaksi' => 'UP_QTY_'.rand(10,1000),
                'tanggal_transaksi' => date('Y-m-d'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);
    
            $id_transaksi = DB::getPdo()->lastInsertId();

            DB::table('detail_transaksi')->insert([
                'id_barang' => $id_barang,
                'id_transaksi' => $id_transaksi,
                'qty' => 20,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);
        }
    
    }
}
