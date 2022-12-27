<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Postingan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $postingan = Postingan::all()->count();
        $user = User::all()->count();
        
        return view('dashboard.index', [
            "postingan" => $postingan,
            "user" => $user
        ]);
    }
}
