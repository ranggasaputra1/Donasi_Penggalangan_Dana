<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berita;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RiwayatTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\KuisionerPenggalangDana;

class CampaignController extends Controller
{
    public function campaign()
    {
        // Mengambil data campaign dengan relasi kategori dan user
        $campaigns = Campaign::with('kuisioner')->latest()->get();

        // Ambil data penggalang dana terbaru
        $penggalangDanas = KuisionerPenggalangDana::latest()->get(); 

        // Menghitung sisa waktu untuk setiap campaign
        foreach ($campaigns as $item) {
            $endDate = Carbon::parse($item->tgl_akhir_campaign);
            $item->sisa_waktu = $endDate->diffInDays(Carbon::now());
        }

        // Mengirim data campaign, kategori, penggalang dana ke view
        return view('admin.campaign', [
            'campaigns' => $campaigns,
            'penggalangDanas' => $penggalangDanas, 
            'title' => 'Data Campaign - We Care',
        ]);
    }

    public function createCampaign(Request $request)
    {
        $valid = $request->validate([
            'judul_campaign' => 'required|string',
            'deskripsi_campaign' => 'required',
            'foto_campaign' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'penggalang_dana_id' => 'required|exists:kuisioner_penggalang_danas,id',
            'kategori_pengajuan' => 'required|string',
            'jumlah_dana_dibutuhkan' => 'required|numeric',
            'jumlah_tanggungan_keluarga' => 'required|integer',
            'pekerjaan' => 'required|string',
            'kondisi_kesehatan' => 'required|string',
            'kebutuhan_mendesak' => 'required|string',
            'lama_pengajuan' => 'required|string',
            'status_korban' => 'required|string',
        ]);

        $imageName = time() . '.' . $request->foto_campaign->extension();
        $request->foto_campaign->move(public_path('storage/images/campaign'), $imageName);

        $penggalangDana = KuisionerPenggalangDana::findOrFail($request->penggalang_dana_id);
        $tglMulaiCampaign = Carbon::now();
        $lamaPengajuan = (int) $penggalangDana->lama_pengajuan;
        $tglAkhirCampaign = $tglMulaiCampaign->copy()->addDays($lamaPengajuan); // Ubah dari months ke days

        Campaign::create([
            'user_id' => Auth::id(),
            'foto_campaign' => $imageName,
            'judul_campaign' => $request->judul_campaign,
            'deskripsi_campaign' => $request->deskripsi_campaign,
            'slug_campaign' => str()->slug($request->judul_campaign),
            'tgl_mulai_campaign' => $tglMulaiCampaign,
            'tgl_akhir_campaign' => $tglAkhirCampaign,
            'target_campaign' => $request->jumlah_dana_dibutuhkan,
            'status_campaign' => 0,
            'penggalang_dana_id' => $request->penggalang_dana_id,
            'kategori_pengajuan' => $request->kategori_pengajuan,
            'jumlah_dana_dibutuhkan' => $request->jumlah_dana_dibutuhkan,
            'jumlah_tanggungan_keluarga' => $request->jumlah_tanggungan_keluarga,
            'pekerjaan' => $request->pekerjaan,
            'kondisi_kesehatan' => $request->kondisi_kesehatan,
            'kebutuhan_mendesak' => $request->kebutuhan_mendesak,
            'lama_pengajuan' => $request->lama_pengajuan,
            'status_korban' => $request->status_korban,
            'no_rekening' => $penggalangDana->no_rekening,
            'no_whatsapp' => $penggalangDana->no_whatsapp,
            'no_rekening_admin' => 'BNI 12345678',
            'no_whatsapp_admin' => '0812345678',
        ]);

        return redirect('/admin/campaign/campaign')->with('message', 'Postingan Donasi berhasil ditambahkan');
    }

    public function editCampaign(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);

        $valid = $request->validate([
            'id' => 'required|exists:campaigns,id',
            'judul_campaign' => 'required|string',
            'deskripsi_campaign' => 'required',
            'foto_campaign' => 'image|mimes:jpeg,png,jpg|max:2048', // optional
            'penggalang_dana_id' => 'required|exists:kuisioner_penggalang_danas,id',
        ]);
        
        // Handle foto_campaign update
        if ($request->hasFile('foto_campaign')) {
            // Hapus foto lama jika ada
            if ($campaign->foto_campaign) {
                $oldImagePath = public_path('storage/images/campaign/' . $campaign->foto_campaign);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Upload foto baru
            $imageName = time() . '.' . $request->foto_campaign->extension();
            $request->foto_campaign->move(public_path('storage/images/campaign'), $imageName);
            $campaign->foto_campaign = $imageName;
        }

        $campaign->judul_campaign = $request->judul_campaign;
        $campaign->deskripsi_campaign = $request->deskripsi_campaign;
        $campaign->slug_campaign = str()->slug($request->judul_campaign);
        $campaign->penggalang_dana_id = $request->penggalang_dana_id;
        
        $campaign->save();

        return redirect('/admin/campaign/campaign')->with('message', 'Postingan Donasi berhasil diperbarui');
    }

    public function lihatcampaign($id)
    {
        $campaign = Campaign::with('kuisioner', 'user')->findOrFail($id);
        return view('admin.lihatcampaign', [
            'campaign' => $campaign,
            'title' => 'Detail Campaign - We Care'
        ]);
    }

    public function deletecampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
        // Hapus juga file fotonya
        if ($campaign->foto_campaign) {
            $imagePath = public_path('storage/images/campaign/' . $campaign->foto_campaign);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $campaign->delete();

        return redirect('/admin/campaign/campaign')->with('message', 'Postingan Donasi berhasil dihapus');
    }

    // Metode-metode lain yang sudah ada tidak saya ubah di sini untuk menghindari redudansi, pastikan Anda menggabungkannya dengan kode yang sudah ada.
    public function getPenggalangDanaData($id)
    {
        $penggalangDana = KuisionerPenggalangDana::findOrFail($id);
        return response()->json($penggalangDana);
    }

     public function showCampaignsForDonors()
    {
        // Mengambil semua data campaign tanpa memfilter status
        $campaigns = Campaign::with('kuisioner')
                            ->latest()
                            ->get();

        return view('donasi.index', [
            'campaigns' => $campaigns,
            'title' => 'Postingan Donasi - We Care'
        ]);
    }


    public function showCampaignDetail($slug)
    {
        $campaign = Campaign::with('kuisioner')->where('slug_campaign', $slug)->firstOrFail();

        return view('donasi.detail', [
            'campaign' => $campaign,
            'title' => $campaign->judul_campaign
        ]);
    }

    public function storeDonation(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:10000',
        ]);

        $transaksi = Transaksi::create([
            'campaign_id' => $request->campaign_id,
            'nama' => $request->donor_name,
            'user_id' => auth()->check() ? auth()->id() : null,
            'nominal_transaksi' => $request->amount,
            'keterangan' => 'Donasi untuk ' . $request->judul_campaign, // Tambahkan ini
            'status_transaksi' => 'pending', // Sesuaikan dengan kolom Anda
        ]);

        return redirect()->route('donasi.konfirmasi', $transaksi->id)->with('message', 'Donasi Anda berhasil dibuat! Silakan selesaikan pembayaran.');
    }

    public function showConfirmationPage($id)
    {
        $transaksi = Transaksi::with('campaign')->findOrFail($id);

        return view('donasi.konfirmasi', [
            'transaksi' => $transaksi, // Ganti 'donation' dengan 'transaksi'
            'title' => 'Konfirmasi Pembayaran'
        ]);
    }
    
    public function uploadProof(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $imageName = Str::slug($transaksi->campaign->judul_campaign . ' ' . $transaksi->nama) . '-' . time() . '.' . $request->proof->extension();
        $request->proof->move(public_path('storage/images/proofs'), $imageName);
        
        // Perbarui record transaksi dengan nama file bukti transfer
        $transaksi->keterangan = $imageName; // Gunakan kolom keterangan atau tambahkan kolom baru
        $transaksi->save();

        return redirect()->route('donasi.detail', $transaksi->campaign->slug_campaign)->with('message', 'Bukti transfer berhasil diunggah. Donasi Anda akan diverifikasi oleh admin.');
    }

   public function confirmTransaksi(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
        ]);

        $transaksi = Transaksi::findOrFail($request->transaksi_id);

        if ($transaksi->status_transaksi == 0) { // status 0 = pending
            // Perbarui status transaksi menjadi sukses (1)
            $transaksi->status_transaksi = 1;
            $transaksi->save();

            // Tambahkan nominal donasi ke dana terkumpul campaign
            $campaign = $transaksi->campaign;
            $campaign->dana_terkumpul += $transaksi->nominal_transaksi;
            $campaign->save();

            // Tambahkan record ke tabel riwayat_transaksi
            RiwayatTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'campaign_id' => $transaksi->campaign_id,
                'user_id' => $transaksi->user_id,
                'nama_donatur' => $transaksi->nama,
                'nominal' => $transaksi->nominal_transaksi,
                'tgl_konfirmasi' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('message', 'Transaksi berhasil dikonfirmasi dan dana telah ditambahkan ke campaign.');
    }

    public function showDonorRiwayatDonasi()
    {
        // Memeriksa apakah ada pengguna yang login
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        // Mengambil semua riwayat donasi (pending, sukses, dll) untuk pengguna yang sedang login
        $transaksi = Transaksi::with('campaign')
                                     ->where('user_id', Auth::id())
                                     ->latest()
                                     ->get();

        return view('donasi.riwayat_donasi', [
            'transaksi' => $transaksi,
            'title' => 'Riwayat Donasi Saya'
        ]);
    }

    public function riwayatDonasiAdmin()
    {
        // Mengambil semua data riwayat transaksi
        $riwayat = RiwayatTransaksi::with(['transaksi', 'campaign', 'user'])->latest()->get();

        return view('admin.riwayat_donasi', [
            'riwayat' => $riwayat,
            'title' => 'Riwayat Donasi Admin'
        ]);
    }

    // Halaman untuk berita campaign
    public function news()
    {
        $news = Berita::with('user')->get();
        return view('admin.berita', [
            'title' => 'Berita Campaign - We Care',
            'news'  => $news,
        ]);
    }

    
    // Menambah berita campaign
    public function tambahnews()
    {
        $campaign = Campaign::with('user')->get();
        return view('admin.tambahberita', [
            'title' => 'Berita Campaign - We Care',
            'campaign'  => $campaign,
        ]);
    }

    // Menambah berita campaign (POST)
    public function posttambahberita(Request $request)
    {
        $valid = $request->validate([
            'judul' => 'required|string',
            'tgl_terbit' => 'date|required',
            'user_id' => 'required',
            'campaign_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=4096,max_height=4096',
            'isi' => 'required',
        ]);
        
        $imagename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('storage/images/berita'), $imagename);

        $berita = new Berita;
        $berita->judul_berita = $request->input('judul');
        $berita->slug_berita = str()->slug($request->input('judul'));
        $berita->tgl_terbit_berita = $request->input('tgl_terbit');
        $berita->user_id = $request->input('user_id');
        $berita->campaign_id = $request->input('campaign_id');
        $berita->gambar_berita = $imagename;
        $berita->isi_berita = $request->input('isi');
        $berita->save();

        return redirect('/admin/campaign/berita')->with('message', 'Berita berhasil ditambahkan');
    }

    // Mengedit berita campaign
    public function editnews($id)
    {
        $berita = Berita::where(['id' => $id])->get();
        return view('admin.editberita', [
            'title' => 'Berita Campaign - We Care',
            'berita'  => $berita,
        ]);
    }

    // Mengedit berita campaign (POST)
    public function posteditberita(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required',
            'judul' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=2048,max_height=2048',
            'isi' => 'required',
        ]);
        
        $id = $request->input('id');
        $berita = Berita::where(['id' => $id])->first();

        if ($request->hasFile('gambar')) {
            $imagename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/images/thumbnail'), $imagename);
            $berita->judul_berita = $request->input('judul');
            $berita->gambar_berita = $imagename;
            $berita->isi_berita = $request->input('isi');
            $berita->save();
        } else {
            $berita->judul_berita = $request->input('judul');
            $berita->isi_berita = $request->input('isi');
            $berita->save();
        }

        return redirect('/admin/campaign/berita')->with('message', 'Berita berhasil diedit');
    }

    // Menghapus berita
    public function deleteberita()
    {
        Berita::where('id', request('id'))->delete();
        return back()->with('message', 'Berita berhasil dihapus');
    }

    // Menampilkan kategori
    public function kategori()
    {
        $kategori = Kategori::all();
        return view('admin.kategori', [
            'title' => 'Kategori - We Care',
            'kategori' => $kategori,
        ]);
    }

    // Menambah kategori
    public function tambahkategori(Request $request)
    {
        $valid = $request->validate([
            'nama_kategori' => 'required|string|unique:kategori'
        ]);
        Kategori::create($valid);
        return back()->with('message', 'Kategori berhasil ditambahkan');
    }

    // Menghapus kategori
    public function deletekategori()
    {
        if (Campaign::where('category_id', request('id'))->first() != null) {
            return back()->with('salah', 'Kategori tidak berhasil dihapus');
        } else {
            Kategori::where('id', request('id'))->delete();
            return back()->with('message', 'Kategori berhasil dihapus');
        }
    }
}
