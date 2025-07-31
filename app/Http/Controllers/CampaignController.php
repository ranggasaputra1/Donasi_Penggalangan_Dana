<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berita;
use App\Models\Campaign;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KuisionerPenggalangDana;

class CampaignController extends Controller
{
    // Menampilkan daftar campaign
    public function campaign()
    {
        $campaign = Campaign::with('category', 'user')->get();  // Mengambil data campaign dengan relasi kategori dan user
        $categories = Kategori::all();  // Ambil kategori untuk form
        $penggalangDanas = KuisionerPenggalangDana::all(); // Ambil data penggalang dana yang sudah mengisi kuisioner
        return view('admin.campaign', [
            'campaign' => $campaign,
            'categories' => $categories,
            'penggalangDanas' => $penggalangDanas, // Pass data penggalang dana ke view
            'title' => 'Data Campaign - We Care',
        ]);
    }

    // Menambah campaign
    public function createCampaign(Request $request)
    {
        // Validasi input
        $valid = $request->validate([
            'judul_campaign' => 'required|string',
            'category_id' => 'required|exists:kategoris,id',
            'deskripsi_campaign' => 'required',
            'foto_campaign' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'penggalang_dana_id' => 'required|exists:kuisioner_penggalang_danas,id', // Menambahkan validasi penggalang dana
        ]);

        // Menyimpan foto campaign
        $imageName = time() . '.' . $request->foto_campaign->extension();
        $request->foto_campaign->move(public_path('storage/images/campaign'), $imageName);

        // Ambil data penggalang dana
        $penggalangDana = KuisionerPenggalangDana::findOrFail($request->penggalang_dana_id);

        // Menyimpan campaign
        Campaign::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'foto_campaign' => $imageName,
            'judul_campaign' => $request->judul_campaign,
            'deskripsi_campaign' => $request->deskripsi_campaign,
            'slug_campaign' => str()->slug($request->judul_campaign),
            'tgl_mulai_campaign' => Carbon::now(),
            'tgl_akhir_campaign' => $request->tgl_akhir,
            'target_campaign' => $request->target_campaign,
            'status_campaign' => 0, // Pending
            'penggalang_dana_id' => $request->penggalang_dana_id,
            'kategori_pengajuan' => $penggalangDana->kategori_pengajuan,
            'jumlah_dana_dibutuhkan' => $penggalangDana->jumlah_dana_dibutuhkan,
            'jumlah_tanggungan_keluarga' => $penggalangDana->jumlah_tanggungan_keluarga,
            'pekerjaan' => $penggalangDana->pekerjaan,
            'kondisi_kesehatan' => $penggalangDana->kondisi_kesehatan,
            'kebutuhan_mendesak' => $penggalangDana->kebutuhan_mendesak,
            'lama_pengajuan' => $penggalangDana->lama_pengajuan,
            'status_korban' => $penggalangDana->status_korban,
        ]);

        return redirect('/admin/campaign/campaign')->with('message', 'Postingan Donasi berhasil ditambahkan');
    }

    // Mengedit status campaign
    public function editstatuscampaign(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required',
            'status' => 'required|in:0,1,2,3', // Status yang bisa dipilih
        ]);

        $campaign = Campaign::findOrFail($request->id);
        $campaign->status_campaign = $request->status;
        $campaign->save();

        return redirect('/admin/campaign/campaign')->with('message', 'Status campaign berhasil diperbarui');
    }

    // Menghapus campaign
    public function deletecampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect('/admin/campaign/campaign')->with('message', 'Postingan Donasi berhasil dihapus');
    }

    // Melihat detail campaign
    public function lihatcampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.lihatcampaign', [
            'campaign' => $campaign,
            'title' => 'Detail Campaign - We Care',
        ]);
    }

    public function getPenggalangDanaData($id)
    {
        // Ambil data penggalang dana berdasarkan ID
        $penggalangDana = KuisionerPenggalangDana::findOrFail($id);

        // Mengembalikan data ke frontend dalam format JSON
        return response()->json($penggalangDana);
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
