<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Postingan extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $with = ["category"];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('headline', 'like' , '%' . $search . '%')
                        ->orWhere('body', 'like' , '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query)  use ($category) {
                $query->where('slug', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentar(){
        return $this->hasMany(Interaction::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function is_liked(){
        return $this->likes->where('user_id', Auth::id())->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
