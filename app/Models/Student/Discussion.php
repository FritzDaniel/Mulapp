<?php

namespace App\Models\Student;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'discussion';
    protected $primaryKey ='id';
    protected $fillable = ['user_id','title','body'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
