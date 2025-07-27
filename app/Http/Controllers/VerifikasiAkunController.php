<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVerify;
use App\Models\VerifikasiAkun;
use App\Models\User;
use Exception;

class VerifikasiAkunController extends Controller
{
    public function verifikasiakun($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $salah = "Maaf email Anda tidak ditemukan.";
        try{
            if (!is_null($verifyUser)) {
                $user = $verifyUser->user;

                if ($user->email_verified_at == null) {
                    $verifyUser->user->email_verified_at = now();
                    $verifyUser->user->save();
                    $message = "Email Anda telah diverifikasi.";
                } else {
                    $message = "Email Anda sudah diverifikasi.";
                }
            }
        }catch (Exception $e){
            return redirect()->route('login')->with('salah', $salah);
        }

        return redirect()->route('login')->with('message', $message);
    }

    public function verifikasiakunktp($id){
        $verifikasi = VerifikasiAkun::where('user_id', $id)->first();
        return view('landing.verifikasiakun', [
            'title' => 'We Care',
            'verifikasi' => $verifikasi,
        ]);
    }

    public function kirimverifikasiakunktp(Request $request)
    {
        if ($request->isMethod('post')) {
            VerifikasiAkun::create([
                'user_id' => $request->user_id,
                'nomor_ktp' => $request->nomor_ktp,
                'nama_ktp' => $request->nama_ktp,
                'foto_ktp' => $request->file('foto_ktp')->store('images/verifikasi', 'public'),
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'status_verifikasi' => 0,
            ]);
            return redirect('/verifikasi-akun/'.$request->user_id);
        }
    }

    public function editstatusverifikasi(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $id = $request->input('id');
        $updateverifikasi = VerifikasiAkun::where(['user_id' => $id])->update([
            'status_verifikasi' => $request->input('status'),
        ]);
        if ($request->input('status') == 1) {
            $updaterole = User::where(['id' => $id])->update([
                'role' => 2,
            ]);
        }


        return redirect('/admin/penggalang-dana/verifikasi-akun')->with('message', 'Status berhasil diedit');
    }
}
