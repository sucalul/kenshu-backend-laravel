<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'thumbnail_image_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail_image()
    {
        return $this->belongsTo(ArticleImage::class, 'thumbnail_image_id');
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
