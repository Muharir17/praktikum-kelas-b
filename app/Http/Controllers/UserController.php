<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Alert;
use PDF;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all(); // select * from user
        return view('user.index', compact('user'));
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        User::create($request->all());
        toast('Berhasil Insert Data', 'info');
        return redirect()->route('pengguna.index');
    }


    public function show($id)
    {
        //
    }

    public function edit(User $pengguna)
    {
        return view('user.edit', compact('pengguna'));
    }


    public function update(Request $request, User $pengguna)
    {
        $pengguna->update($request->all());
        Alert::success('Berhasil', 'Update Sukses');
        return redirect()->route('pengguna.index');
    }


    public function destroy(User $pengguna)
    {
        $pengguna->destroy($pengguna->id);
        Alert::success('Berhasil', 'Hapus Sukses');
        return redirect()->route('pengguna.index');
    }

    public function print()
    {
        $pengguna = User::all();
        $pdf = PDF::loadView('user.cetak', compact('pengguna'));
        return $pdf->stream('cetak pengguna.pdf');
    }
}
