<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;

class CourseVideos extends Model
{
    protected $table = 'course_videos';
    protected $primaryKey ='id';
    protected $fillable = ['course_id','title','slug','description','video'];
    public $timestamps = true;

    public function course()
    {
        return $this->belongsTo(Courses::class,'course_id');
    }
}
