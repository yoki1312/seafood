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
use TintNaingWin\EmailChecker;


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
        $user = DB::table('admins')->where('id', $id)->first();
        $messageEmail = [
            'title' => 'Pendaftara Penjual Baru',
            'body' => 'Akun anda telah di aktifkan'
        ];
        \Mail::to($user->email)->send(new \App\Mail\KonfirmasiPenjualan($messageEmail));
        DB::table('admins')->where('id', $id)->update([
            'status_aktif' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'tanggal_aktif' => date('Y-m-d'),
        ]);
        toastr()->success('Akun berhasil di aktifkan ', 'Berhasil!');
        return redirect('akunSupplier/detail/' .$id);
    }

    public function nonaktif($id)
    {
        $user = DB::table('admins')->where('id', $id)->first();
        $messageEmail = [
            'title' => 'Pendaftara Penjual Baru',
            'body' => 'Akun anda telah di non aktifkan'
        ];
        \Mail::to($user->email)->send(new \App\Mail\KonfirmasiPenjualan($messageEmail));
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
 
        DB::beginTransaction();

        try {
            $fileName = "";
            if(isset($request->file)){
                $r = $request->file('file');
                $fileName = 'foto-supplier-'.time()."_". str_replace(' ','_',$request['nama_supplier']);
                $r->move(public_path().'/foto-supplier', $fileName);
            }
    
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
            
            toastr()->success('Akun anda berhasil terdaftar, silahkan menunggu akun anda di aktifkan oleh admin ', 'Berhasil!');
            \Mail::to(getContackUs()->email_center)->send(new \App\Mail\KonfirmasiPenjualan(array(
                'title' => 'Pendaftaran Penjual Baru',
                'body'  => 'Klik link dibawah ini untuk akivasi user baru',
                'button'    =>  url('akunSupplier/aktif/'.$id_supplier) . '?params='. rand(10,40),
                'text_button'   => 'Aktifkan Akun'
            )));
    
            \Mail::to($request['email'])->send(new \App\Mail\KonfirmasiPenjualan(array(
                'title' => 'Pendaftara Penjual Baru',
                'body' => 'Akun anda berhasil terdaftar pada website serba serbi ujungpangkah, silahkan menunggu akun anda di aktifkan oleh admin'
            )));
            DB::commit();
            // all good
        } catch (\Exception $e) {
            printJSON($e->getMessage());
            DB::rollback();
        // something went wrong
        }

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

            return redirect()->intended('/admin');
        }
        // toastr()->success('Login Berhasil', 'Berhasil!');
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->intended('login/supplier');
    }

    public function tet(){
        $data =  EmailChecker::check('yokihidayaturr13@gmail.com');
        dd($data);
    //    $id_supplier = '1';

    //    $cek =  \Mail::to('yokihidayatursr13@gmail.com')->send(new \App\Mail\KonfirmasiPenjualan(array(
    //         'title' => 'test',
    //         'body'  => 'Klik link dibawah ini untuk akivasi user baru',
    //         'button'    =>  url('akunSupplier/aktif/'.$id_supplier),
    //         'text_button'   => 'Aktifkan Akun'
    //     )));
    //     dd($cek);
     
    }
}
