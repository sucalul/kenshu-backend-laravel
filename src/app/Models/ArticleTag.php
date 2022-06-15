<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'article_tags';

    protected $fillable = [
        'article_id',
        'tag_id'
    ];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

}
