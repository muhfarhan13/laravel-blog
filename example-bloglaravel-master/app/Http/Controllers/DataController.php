<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $datas = Data::all();
        return view('/index',compact('datas'));
    }
    public function tambah(){
        return view('tambah');
    }
    public function simpan(Request $request){
        $request->validate([
            'gambar' => 'required',
            'judul' => 'required',
            'conten' => 'required',
        ]);

        // $sendgambar = $request->gambar->getClientOriginalName().'_'. time().'_'. $request->gambar->extension();
        // $request->gambar->move(public_path('images'),$sendgambar);
        Data::create([
            'gambar'=>$request['gambar'],
            'judul'=>$request['judul'],
            'conten'=>$request['conten']
        ]);
        return redirect('index')->with('status','Data Berhasil Di Tambah');
    }
    public function delete(Request $request,$id){
        $datas = Data::find($id);
        $datas->delete();
        return redirect('index')->with('status','Data Berhasil Di Hapus');

    }
    public function edit($id)
{
    $datas = Data::where('id', $id)->first();
    return view('edit',compact('datas'));
}
    public function update(Request $request,$id){
        $datas = Data::find($id);
        $datas->judul = $request->judul;
        $datas->conten = $request->conten;
        if($request->gambar == ''){
            $datas->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');
        }
        else{
            $datas->gambar = $request->gambar;

            $datas->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');

        }
        
    }
}
