<?php

namespace App\Models\Teacher;

use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';
    protected $primaryKey ='id';
    protected $fillable = ['user_id','category_id','title','slug','status'];
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
