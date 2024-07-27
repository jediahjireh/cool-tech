<?php
// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // specify the correct table name
    protected $table = 'tags';

    // specify the primary key
    protected $primaryKey = 'tag_id';

    // define relationship to articles through the pivot table
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id')
            ->using(ArticleTag::class);
    }
}
