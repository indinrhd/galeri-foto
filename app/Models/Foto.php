<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Foto extends Model
{
    use HasFactory, sluggable;
    
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'foto' => 'judul_foto'
                ]
            ];
        }
        
        protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Komentar::class);
    }

    public function hasLike()
    {
        return $this->hasOne(Like::class)->where('likes.user_id', Auth::user()->id);
    }

    public function hasLikee()
    {
        return $this->hasOne(Like::class)->where('likes.user_id', '1');
    }

    public function totalLikes()
    {
        return $this->hasMany(Like::class)->count();
    }

}
