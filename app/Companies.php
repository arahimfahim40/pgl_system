<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Companies extends Model {

    protected $fillable = [
        'id','name','vip','has_mixcontainer'
    ];
}