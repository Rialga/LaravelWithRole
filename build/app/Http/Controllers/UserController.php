<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pangkat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function input(Request $request){

            $user = new User;
            $user->nip = $request->nip;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->pangkat = $request->pangkat;
            $user->role = $request->jabatan;
            $user->password = Hash::make($request['password']);
            if($user->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Instansi"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Instansi"));
            }
    }

    public function listjabatan(){
        $jabatan = Jabatan::all();
        return json_encode($jabatan);
    }

    public function listpangkat(){
        $pangkat = Pangkat::all();
        return json_encode($pangkat);
    }
}
