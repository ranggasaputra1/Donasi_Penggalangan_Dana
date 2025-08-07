<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Campaign;
use App\Models\Transaksi;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use App\Models\RiwayatTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $transaksi = Transaksi::with('user')->get();
        return view('admin.transaksi', [
            'title' => 'Transaksi - We Care',
            'transaksi' => $transaksi,
        ]);
    }

    public function mydonation()
    {
        $transaksi = Transaksi::with('campaign')->where('user_id', Auth::user()->id)->get();
        return view('landing.mydonasi', [
            'transaksi'  => $transaksi,
        ]);
    }


    public function create(Request $request)
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $request->input('nominal'));
        if ($request->isMethod('post')) {
            $transaksi = Transaksi::create([
                'user_id' => $request->user_id,
                'campaign_id' => $request->campaign_id,
                'nominal_transaksi' => $nominal,
                'nama' => $request->nama,
                'tgl_transaksi' => Carbon::now(),
                'keterangan' => $request->pesan,
                'status_transaksi' => 0,
            ]);
            $id = $transaksi->id;

            return redirect('/checkout/' . $id)->with('success', 'Donasi berhasil dilakukan');
        }
        return view('/');
    }

    public function checkout($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $campaign = Campaign::findOrFail($transaksi->campaign_id);
        $user = User::findOrFail($transaksi->user_id);
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Config::$serverKey = 'SB-Mid-server-mzlZbKG5pog43pNjc8xUVdxT';

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;

        // Set transaction's order_id. Must be unique.
        $orderId = $transaksi->id;

        // Set transaction's amount (required)
        $amount = $transaksi->nominal_transaksi + 5000;

        // Set transaction's customer details
        $customerDetails = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Initialize transaction parameter
        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customerDetails,
        ];

        // Create Snap Token transaction
        $snapToken = Snap::getSnapToken($transaction);

        // Render checkout page with Snap Token
        // return view('checkout', compact('snapToken'));

        return view('landing.checkout', [
            'transaksi' => $transaksi,
            'campaign' => $campaign,
            'snapToken' => $snapToken,
        ]);
    }
     // METHOD UNTUK MENOLAK DONASI
    public function rejectTransaksi(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'keterangan_admin' => 'required|string|max:255',
        ]);
        $transaksi = Transaksi::findOrFail($request->transaksi_id);
    
        // Cek status transaksi, hanya bisa menolak jika masih Pending (0)
        if ($transaksi->status_transaksi == 0) {
            // Update status transaksi di tabel utama
            $transaksi->status_transaksi = 2; // Status Dibatalkan
            $transaksi->keterangan_admin = $request->keterangan_admin;
            $transaksi->save();

            // Penyesuaian: Tambahkan record ke tabel riwayat_transaksi
            RiwayatTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'campaign_id' => $transaksi->campaign_id,
                'user_id' => $transaksi->user_id,
                'nama_donatur' => $transaksi->nama,
                'nominal' => $transaksi->nominal_transaksi,
                'tgl_konfirmasi' => Carbon::now(),
                'status' => 2, // Status Dibatalkan
                'keterangan_admin' => $request->keterangan_admin,
            ]);
        }
    
        return redirect()->back()->with('success', 'Transaksi berhasil ditolak dan status diubah menjadi Dibatalkan.');
    }
}