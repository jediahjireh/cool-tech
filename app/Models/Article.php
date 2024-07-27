<?php
// app/Models/Article.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // specify the correct table name
    protected $table = 'articles';
    // specify the primary key
    protected $primaryKey = 'article_id';

    // disable default timestamps
    public $timestamps = false;


    protected $fillable = [
        'article_title',
        'article_content',
        'category_id',

        // custom timestamp
        'article_creation_date'
    ];

    // define the tags relationship with custom pivot model
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id')
            ->using(ArticleTag::class);
    }

    /* This setup allows all tags associated with the article to be retrieved easily:
        $article = Article::find($articleId);
        $tags = $article->tags; */
}
