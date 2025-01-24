<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurWork extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'title',
        'count'
    ];
}
