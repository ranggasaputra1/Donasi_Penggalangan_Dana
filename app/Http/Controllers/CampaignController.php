<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CampaignController extends Controller
{
    public function index($slug)
    {
        $campaign = Campaign::where('slug_campaign', $slug)->first();
        $berita = Berita::where('campaign_id', $campaign->id)->latest()->get();
        $doa = Transaksi::with('user')->where('campaign_id', $campaign->id)->where('status_transaksi', 1)->limit(3)->latest()->get();
        if ($campaign->status_campaign == 1) {
            return view('landing.campaign', [
                'campaign'  => $campaign,
                'doa' => $doa,
                'berita' => $berita,
            ]);
        } else {
            return view('errors.404');
        }
    }

    public function berita($slug, $slugberita)
    {
        $campaign = Campaign::where('slug_campaign', $slug)->first();
        $berita = Berita::where('slug_berita', $slugberita)->get();
        if ($campaign->status_campaign == 1) {
            return view('landing.beritacampaign', [
                'campaign'  => $campaign,
                'berita' => $berita,
            ]);
        } else {
            return view('errors.404');
        }
    }

    public function campaign()
    {
        $campaign = Campaign::all();
        return view('admin.campaign', [
            'campaign'  => $campaign,
            'title' => 'Data Campaign - We Care',
        ]);
    }

    public function lihatcampaign($id)
    {
        $campaign = Campaign::where('id', $id)->get();
        return view('admin.lihatcampaign', [
            'campaign'  => $campaign,
            'title' => 'Data Campaign - We Care',
        ]);
    }

    public function mycampaign()
    {
        $campaign = Campaign::where('user_id', Auth::user()->id)->get();
        return view('landing.mycampaign', [
            'campaign'  => $campaign,
        ]);
    }

    public function editstatuscampaign(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $id = $request->input('id');
        $updateverifikasi = Campaign::where(['id' => $id])->update([
            'status_campaign' => $request->input('status'),
        ]);

        return redirect('/admin/campaign/campaign')->with('message', 'Status berhasil diedit');
    }


    public function news()
    {
        $news = Berita::with('user')->get();
        return view('admin.berita', [
            'title' => 'Berita Campaign - We Care',
            'news'  => $news,
        ]);
    }

    public function tambahnews()
    {
        $campaign = Campaign::with('user')->get();
        return view('admin.tambahberita', [
            'title' => 'Berita Campaign - We Care',
            'campaign'  => $campaign,
        ]);
    }

    public function editnews($id)
    {
        $berita = Berita::where(['id' => $id])->get();
        return view('admin.editberita', [
            'title' => 'Berita Campaign - We Care',
            'berita'  => $berita,
        ]);
    }

    public function uploadgambar(Request $request)
    {

        $path_url = 'storage/images/berita';
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path($path_url), $fileName);
            $url = asset($path_url . '/' . $fileName);
        }

        return response()->json(['url' => $url]);
    }

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

    public function deleteberita()
    {
        Berita::where('id', request('id'))->delete();
        return back()->with('message', 'Berita berhasil dihapus');
    }

    public function kategori()
    {
        $kategori = Kategori::all();
        return view('admin.kategori', [
            'title' => 'Kategori - We Care',
            'kategori' => $kategori,
        ]);
    }

    public function tambahkategori(Request $request)
    {
        $valid = $request->validate([
            'nama_kategori' => 'required|string|unique:kategori'
        ]);
        Kategori::create($valid);
        return back()->with('message', 'Kategori berhasil ditambahkan');
    }

    public function deletekategori()
    {
        if (Campaign::where('category_id', request('id'))->first() != null) {
            return back()->with('salah', 'Kategori tidak berhasil dihapus');
        } else {
            Kategori::where('id', request('id'))->delete();
            return back()->with('message', 'Kategori berhasil dihapus');
        }
    }

    public function uploadgambarcampaign(Request $request)
    {

        $path_url = 'storage/images/campaign';
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path($path_url), $fileName);
            $url = asset($path_url . '/' . $fileName);
        }

        return response()->json(['url' => $url]);
    }

    public function createcampaigndonatur(Request $request)
    {
        if ($request->isMethod('post')) {
            Campaign::create([
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'foto_campaign' => $request->file('image')->store('images/campaign', 'public'),
                'judul_campaign' => $request->judul_campaign,
                'deskripsi_campaign' => $request->deskripsi_campaign,
                'slug_campaign' => str()->slug($request['judul_campaign']),
                'tgl_mulai_campaign' => Carbon::now(),
                'tgl_akhir_campaign' => $request->tgl_akhir,
                'target_campaign' => $request->target_campaign,
                'status_campaign' => 0,
            ]);
            return redirect('/');
        }
        return view('/');
    }
}
