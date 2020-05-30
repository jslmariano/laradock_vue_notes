<?php

namespace Jslmariano\Aiodin\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    protected $fillable = ['USERID','NAME','ADDRESS','AGE'];
    protected $table = 'TBL_CUSTOMERS';
}
