<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blog()
    {
        $blog = Blog::with('user')->get();
        return view('admin.blog', [
            'title' => 'Blog - We Care',
            'blog'  => $blog,
        ]);
    }

    public function blogview()
    {
        $blog = Blog::with('user')->paginate(9);
        return view('landing.blog', [
            'title' => 'Blog - We Care',
            'blog'  => $blog,
        ]);
    }

    public function blogviewdetail($slug)
    {
        $blog = Blog::where('slug_blog', $slug)->first();
        if ($blog != null) {
            $artikel = Blog::with('user')->where('slug_blog', $slug)->get();
            return view('landing.artikelblog', [
                'title' => 'Blog - We Care',
                'artikel'  => $artikel,
            ]);
        } else {
            return view('errors.404');
        }
    }

    public function deleteartikel()
    {
        Blog::where('id', request('id'))->delete();
        return back()->with('message', 'Artikel berhasil dihapus');
    }

    public function tambahartikel()
    {
        return view('admin.tambahartikel', [
            'title' => 'Tambah Artikel - We Care',
        ]);
    }

    public function editartikel($id)
    {
        $artikel = Blog::where(['id' => $id])->get();
        return view('admin.editartikel', [
            'title' => 'Edit Artikel - We Care',
            'artikel'  => $artikel,
        ]);
    }

    public function uploadgambar(Request $request)
    {

        $path_url = 'storage/images/article';
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

    public function posttambahartikel(Request $request)
    {
        $valid = $request->validate([
            'judul' => 'required|string',
            'tgl_terbit' => 'date|required',
            'user_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=4096,max_height=4096',
            'isi' => 'required',
        ]);
        $imagename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('storage/images/thumbnail'), $imagename);

        $slug = str()->slug($valid['judul']);
        $blog = new Blog;
        $blog->judul_blog = $request->input('judul');
        $blog->tgl_terbit_blog = $request->input('tgl_terbit');
        $blog->user_id = $request->input('user_id');
        $blog->gambar_blog = $imagename;
        $blog->isi_blog = $request->input('isi');
        $blog->slug_blog = $slug;
        $blog->save();
        return redirect('/admin/artikel-blog')->with('message', 'Artikel berhasil ditambahkan');
    }

    public function posteditartikel(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required',
            'judul' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=2048,max_height=2048',
            'isi' => 'required',
        ]);
        $id = $request->input('id');
        $blog = Blog::where(['id' => $id])->first();
        if ($request->hasFile('gambar')) {
            $imagename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/images/thumbnail'), $imagename);
            $blog->judul_blog = $request->input('judul');
            $blog->gambar_blog = $imagename;
            $blog->isi_blog = $request->input('isi');
            $blog->save();
        } else {
            $blog->judul_blog = $request->input('judul');
            $blog->isi_blog = $request->input('isi');
            $blog->save();
        }



        return redirect('/admin/artikel-blog')->with('message', 'Artikel berhasil diedit');
    }
}
