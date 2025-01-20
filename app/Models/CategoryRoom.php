<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRoom extends Model
{
    protected $table = 'category_room';
    protected $primaryKey = 'id';

    protected $fillable = [
        'label',
    ];
}
