<?php

namespace App\Models\Blog;

use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    protected $primaryKey ='id';
    protected $fillable = ['user_id','category_id','title','slug','body','allow_comment'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
