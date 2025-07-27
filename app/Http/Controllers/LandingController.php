<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Campaign;
use App\Models\Kategori;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    const title = 'We Care';

    public function index()
    {
        $kategori = Kategori::all();
        $campaign = Campaign::where('status_campaign', 1)->orderBy('tgl_akhir_campaign', 'asc')->paginate(6);
        $blog = Blog::latest()->limit(3)->get();
        return view('landing.home', [
            'kategori' => $kategori,
            'blog' => $blog,
            'title' => 'We Care',
            'campaign'  => $campaign,
        ]);
    }

    public function kategori($kategori)
    {
        if($kategori == 'pendidikan'){
            $kat = 1;
        }elseif($kategori == 'sosial'){
            $kat = 2;
        }elseif($kategori == 'kesehatan'){
            $kat = 3;
        }
        $campaign = Campaign::where('category_id', $kat)->where('status_campaign', 1)->orderBy('tgl_akhir_campaign', 'asc')->paginate(6);
        return view('landing.kategori', [
            'campaign' => $campaign,
            'kat' => $kat,
            'title' => 'We Care',
        ]);
    }

    public function cari(Request $request)
    {
        if (!$request->has('filter')) {
            return redirect('/');
        }
        $cari = $request->input('filter');
        $results = Campaign::where('status_campaign', 1)->where('judul_campaign', 'like', "%{$cari}%")->get();

        return response()->json($results);
    }
}
