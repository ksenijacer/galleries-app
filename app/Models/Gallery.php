<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function firstImage()
    {
        return $this->hasOne(Image::class)->ofMany('id', 'min');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    // public function scopeOrWhereName($query, $search = '')
    // {
    //     if ($search) {
    //         return $query->orWhere('name', 'like', "%{$search}%");
    //     }
    // }

    // public function scopeOrWhereDescription($query, $search = '')
    // {
    //     if ($search) {
    //         return $query->orWhere('description', 'like', "%{$search}%");
    //     }
    // }

    // public function scopeOrWhereUserName($query, $search = '')
    // {

    //     if ($search) {
    //         return $query->orWhereRelation('user', 'first_name', 'like', "%{$search}%")
    //             ->orWhereRelation('user', 'last_name', 'like', "%{$search}%");
    //     }
    // }
}



   