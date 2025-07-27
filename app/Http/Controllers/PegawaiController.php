<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{

    public function pegawai()
    {
        $pegawai = User::all()->where('role', 0)->where('id', '!=', Auth::user()->id);
        return view('admin.pegawai', [
            'title' => 'Pegawai - We Care',
            'pegawai' => $pegawai,
        ]);
    }

    public function tambahpegawai(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string',
            'email' => 'email|required|unique:users',
            'phone_number' => 'required|numeric',
            'role' => 'required|numeric',
            'password' => 'required|string|min:8',
            'password_confirm' => 'required'
        ]);
        $valid['password'] = Hash::make($request->password);
        User::create($valid);
        return back()->with('message', 'Pegawai berhasil ditambahkan');
    }

    public function deletepegawai()
    {
        User::where('id', request('id'))->delete();
        return back()->with('message', 'Pegawai berhasil dihapus');
    }
}
