<?php

namespace App\Teacher;

use App\Models\Teacher\Courses;
use Illuminate\Database\Eloquent\Model;

class CourseData extends Model
{
    protected $table = 'course_data';
    protected $primaryKey ='id';
    protected $fillable =
        [
            'course_id',
            'objective','requirement','target',
            'priceType','price',
            'description','thumbnail'
        ];
    public $timestamps = true;

    public function course()
    {
        return $this->belongsTo(Courses::class,'course_id');
    }
}
