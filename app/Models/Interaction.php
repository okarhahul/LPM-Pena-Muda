<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postingan(){
        return $this->belongsTo(Postingan::class);
    }

    public function singlepost(){
        return $this->belongsTo(Postingan::class);
    }
}
