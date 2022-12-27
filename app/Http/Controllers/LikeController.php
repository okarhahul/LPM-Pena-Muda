<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // public function togle($postingan_id)
    // {
    //     $postingan = Postingan::findOrFail($postingan_id);
    //     $validated = ['user_id' => Auth::id()];

    //     if($postingan->likes()->where($validated)->existst()) {
    //         $postingan->likes()->where($validated)->delete();
    //         $msg = ['status' => 'UNLIKE'];
    //     } else {
    //         $postingan->likes()->create($validated);
    //         $msg = ['status' => 'LIKE'];
    //     }

    //     return response()->json($msg);
    // }

    public function toggle($postingan_id) {

        $postingan = Postingan::findOrFail($postingan_id);
        $validated = ['user_id' => Auth::id()];

        if($postingan->likes()->where($validated)->exists()) {
            $postingan->likes()->where($validated)->delete();
            $msg = ['status' => 'UNLIKE'];
        } else {
            $postingan->likes()->create($validated);
            $msg = ['status' => 'LIKE'];
        }
        
        return response()->json($msg);
    }
}
