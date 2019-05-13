<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NotifyList extends Model
{
    protected $table = 'notify_list';
    protected $primaryKey ='id';
    protected $fillable = ['notify_id','user_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function notify()
    {
        return $this->belongsTo(Notify::class,'notify_id');
    }
}
