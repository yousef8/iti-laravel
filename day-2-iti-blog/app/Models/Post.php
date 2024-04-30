<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'image'];
    protected static function boot()
    {
        parent::boot();

        // Listen for the 'deleting' event
        static::deleting(function ($post) {
            // If the post has an associated image, delete the image file from storage
            if ($post->image) {
                Storage::disk('public')->delete('images/' . basename($post->image));
            }
        });
    }
}
