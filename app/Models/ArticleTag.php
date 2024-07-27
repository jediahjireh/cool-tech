<?php
// app/Models/ArticleTag.php
namespace App\Models;

// import class providing base functionality for Eloquent pivot models
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleTag extends Pivot
{
    // specify the correct table name
    protected $table = 'article_tag';

    // specify the primary key
    protected $primaryKey = 'article_id, tag_id';

    /* additional attributes/methods for tracking extra information
    related to the relationship between articles and tags */
}
