<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $primaryKey ='id';
    protected $fillable = ['user_id','tags'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
