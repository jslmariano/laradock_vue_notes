<?php

namespace Jslmariano\Notelist\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    protected $fillable = ['id','title','content'];
    protected $table = 'notes';
}
