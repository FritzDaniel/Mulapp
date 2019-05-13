<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';
    protected $primaryKey ='id';
    protected $fillable = ['type','title','body'];
    public $timestamps = true;
}
