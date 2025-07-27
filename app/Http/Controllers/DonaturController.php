<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifikasiAkun;

class DonaturController extends Controller
{
    const title = 'Donatur - We Care';

    public function donatur()
    {
        $donatur = User::all()->where('role', 1);
        return view('admin.donatur', [
            'title' => self::title,
            'donatur' => $donatur,
        ]);
    }

    public function penggalangdana()
    {
        $penggalangdana = User::all()->where('role', 2);
        return view('admin.penggalangdana', [
            'title' => self::title,
            'penggalangdana' => $penggalangdana,
        ]);
    }

    public function verifikasiakun()
    {
        $verifikasiakun = VerifikasiAkun::paginate(10);
        return view('admin.verifikasiakun', [
            'title' => self::title,
            'verifikasiakun' => $verifikasiakun,
        ]);
    }

}
