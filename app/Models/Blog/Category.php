<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'blogs_category';
    protected $primaryKey ='id';
    protected $fillable = ['category'];
    public $timestamps = true;
}
