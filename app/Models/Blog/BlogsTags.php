<?php

namespace App\Models\Blog;

use App\Models\Tags;
use Illuminate\Database\Eloquent\Model;

class BlogsTags extends Model
{
    protected $table = 'blogs_tags';
    protected $primaryKey ='id';
    protected $fillable = ['blogs_id','tags_id'];
    public $timestamps = true;

    public function tags()
    {
        return $this->belongsTo(Tags::class,'tags_id');
    }
}
