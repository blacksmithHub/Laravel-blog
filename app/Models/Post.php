<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'published_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            Log::info('RECORD CREATED!!!');
        });
        static::creating(function ($model) {
            Log::info('RECORD CREATING!!!');
        });
        static::updated(function ($model) {
            //
        });
        static::updating(function ($model) {
            //
        });
        static::deleted(function ($model) {
            //
        });
        static::deleting(function ($model) {
            //
        });
        static::saved(function ($model) {
            Log::info("RECORD SAVED!!!");
        });
        static::saving(function ($model) {
            Log::info("RECORD SAVING!!!");
        });
        // static::restored();
        // static::restoring();
        // static::retrieved();
        // static::replicating();
    }

    /**
     * Relationship to users table.
     * 
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * This will update post content.
     * 
     * @param string|int $id
     * @param array $param
     * @return mixed
     */
    public function updatePost($id, $param)
    {
        return $this->where('id', $id)->update($param);
    }

    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at');
    }
}
