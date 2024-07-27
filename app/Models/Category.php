<?php
// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // table associated with the model
    protected $table = 'categories';

    // primary key
    protected $primaryKey = 'category_id';

    // enable auto-incrementing
    public $incrementing = true;

    // disable timestamps
    public $timestamps = false;

    // define the fillable attributes for mass assignment
    protected $fillable = [
        'category_name',
    ];

    // define the relationship with the Article model
    public function articles()
    {
        //  one-to-many relationship with category_id as the foreign key
        return $this->hasMany(Article::class, 'category_id', 'category_id');
    }
}
