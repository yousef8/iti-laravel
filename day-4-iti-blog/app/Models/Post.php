<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['title', 'body', 'image', 'user_id'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            if ($post->image) {
                Storage::disk('public')->delete('images/' . basename($post->image));
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
