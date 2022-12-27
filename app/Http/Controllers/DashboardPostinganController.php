<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Postingan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardPostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.postingan.index',[
            'postingan' => Postingan::latest()->filter(request(['search']))->where('user_id', auth()->user()->id)->get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.postingan.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => ['required', 'max:150'],
            'penulis' => ['required', 'max:150'],
            'editor' => ['max:50'],
            'category_id' => ['required'],
            'image' => ['image', 'file'],
            'waktu' =>['date', 'required'],
            'body' => ['required']
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('postingan-images');
        }

        $validatedData['user_id'] = Auth::id();
        
        // dd($validateData);

         // Cek ketika ada judul yg sama, maka slug nya kita bedain
 
        // ambil semua data Postingan
        $postingan = Postingan::all();
 
        // cocokin apakah udah ada
        $filteredJudul = $postingan->where('judul', $validatedData['judul'])->all();
 
        // kalo ada, slug nya di bedain
        // kalo ga ya yauda paek yg request judul yg baru
        if($filteredJudul != null) {
            $judul = collect($filteredJudul)->first()->judul;
            $newSlug = Str::of($judul)->append(" " . mt_rand(1,10));
            $validatedData['slug'] = Str::slug($newSlug, '-');
        } else {
            $validatedData['slug'] = Str::slug($validatedData['judul'], '-');
        }
 
        $validatedData['headline'] = Str::limit(strip_tags($validatedData['body'], 25));

        // dd($validatedData);

        Postingan::create($validatedData);

        return redirect('/dashboard/postingan')->with('success', 'postingan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(Postingan $postingan)
    {
        return view('dashboard.postingan.show', [
            'singlepost' => $postingan
        ]);

        // return $postingan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Postingan $postingan)
    {
        return view('dashboard.postingan.edit', [
            'postingan' => $postingan,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postingan $postingan)
    {
       /*
        casenya adalah ketika menggupdate data dengan mengganti judul, maka slug akan keganti
        */

        // ini kalo title nya ganti ,sama kita pakein slug yg udah ada di db sblumnya
        if($postingan->judul == $request->judul) {
 
            $currentSlug = $postingan->slug;
        } else {
 
            // cek kalo judul ganti, pastiin di db udah ada blom
            $queryJudul = Postingan::where('judul', $request->judul)->get();
 
            // ada judul yg sama di db
            if(count($queryJudul) != 0) {
                $currentSlug = Str::slug($request->judul . " " . Str::random(5), '-');
            } else {
 
                // ga sama dgn di db
                $currentSlug =  Str::slug($request->judul, '-');
            }
 
        }
 
        // validasi
        $validatedData = $request->validate([
            'judul' => ['required', 'max:150'],
            'category_id' => ['required'],
            'penulis' => ['required', 'max:150'],
            'editor' => ['required', 'max:50'],
            'image' => ['image', 'file'],
            'waktu' =>['date', 'required'],
            'body' => ['required']
        ]);

        // validasi apakah ada gambar baru atau tidak
        if($request->file('image')){

            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('postingan-images');
        }
 
        // add anoteher field
        $validatedData['slug'] = $currentSlug;
        $validatedData['user_id'] = Auth::id(); // ambil id yg sedang login
        $validatedData['headline'] = Str::limit(strip_tags($validatedData['body'], 25));
 
        Postingan::where('id', $postingan->id)
            ->update($validatedData);
 
        return redirect('/dashboard/postingan')->with('success', "Postingan berhasil di ubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postingan $postingan)
    {
        if($postingan->image){
            Storage::delete($postingan->image);
        }

        Postingan::destroy($postingan->id);
        return redirect('/dashboard/postingan')->with('success', 'Postingan berhasil dihapus!');
    }
}
