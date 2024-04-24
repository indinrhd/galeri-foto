<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function childrens()
    {
        return $this->hasMany(Komentar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
