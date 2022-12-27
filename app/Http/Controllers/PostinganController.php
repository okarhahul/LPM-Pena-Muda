<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\Request;
use App\Models\Postingan;

class PostinganController extends Controller
{
    public function index()
    {
        return view('postingan', [
            "title" => "Semua Postingan",
            "postingan" => Postingan::latest()->with(['category'])->filter(request(['search', 'category']))->get(),
        ]);
    }

    public function show(Postingan $postingan)
    {
        return view('singlepost', [
            "title" => "Single Post",
            "singlepost" => $postingan ,
            "comments" => Interaction::where('singlepost_id', $postingan->id)->get(),
        ]);
    }

    public function search(){
        $filter = request()->query();
        return Postingan::latest()->where('judul', 'like', "%{$filter['search']}%")->get();
    }
}
