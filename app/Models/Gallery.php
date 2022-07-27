<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->whereHas("user", function ($q) use ($searchTerm) {
            $q->where("firstName", "LIKE", "%$searchTerm%")->orWhere("lastName", "LIKE", "%$searchTerm%");
        })->orWhere("title", "LIKE", "%$searchTerm%")->orWhere("description", "LIKE", "%$searchTerm%");
    }
}



   