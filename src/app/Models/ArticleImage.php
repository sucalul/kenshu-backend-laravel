<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class ArticleImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'article_images';

    protected $fillable = [
        'article_id',
        'resource_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
