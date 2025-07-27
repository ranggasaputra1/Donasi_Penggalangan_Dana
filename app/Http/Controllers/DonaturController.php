<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifikasiAkun;

class DonaturController extends Controller
{
    const title = 'Donatur - We Care';

    /** ✅ List Donatur */
    public function donatur()
    {
        $donatur = User::where('role', 1)->get();
        return view('admin.donatur', [
            'title' => self::title,
            'donatur' => $donatur,
        ]);
    }

    /** ✅ List Penggalang Dana */
    public function penggalangdana()
    {
        $penggalangdana = User::where('role', 2)->get();
        return view('admin.penggalangdana', [
            'title' => self::title,
            'penggalangdana' => $penggalangdana,
        ]);
    }

    /** ✅ Verifikasi Akun */
    public function verifikasiakun()
    {
        $verifikasiakun = VerifikasiAkun::paginate(10);
        return view('admin.verifikasiakun', [
            'title' => self::title,
            'verifikasiakun' => $verifikasiakun,
        ]);
    }

    /** ✅ Detail Donatur */
    public function detail($id)
    {
        $donatur = User::findOrFail($id);
        return view('admin.donatur-detail', [
            'title' => 'Detail Donatur - We Care',
            'donatur' => $donatur,
        ]);
    }

    /** ✅ Form Edit Donatur */
    public function edit($id)
    {
        $donatur = User::findOrFail($id);
        return view('admin.donatur-edit', [
            'title' => 'Edit Donatur - We Care',
            'donatur' => $donatur,
        ]);
    }

    /** ✅ Update Donatur */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $donatur = User::findOrFail($request->id);
        $donatur->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect('/admin/donatur')->with('message', 'Akun Donatur berhasil diupdate.');
    }

    /** ✅ Hapus Donatur */
    public function hapus(Request $request)
    {
        $donatur = User::findOrFail($request->id);
        $donatur->delete();
        return redirect('/admin/donatur')->with('message', 'Akun Donatur berhasil dihapus.');
    }
}
