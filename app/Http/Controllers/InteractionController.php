<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    public function Komentar (Request $request, Postingan $postingan)
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $interaction = Interaction::create($request->all());

        $id_interaction = Interaction::where('id', $interaction->id)->first()->id;

        $id_postingan = $request->singlepost_id;
        Postingan::where('id', $id_postingan)
            ->update(['interaction_id' => $id_interaction]);
           
        return redirect()->back();
    }

    
}
