<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsageRoom extends Model
{
    protected $table = 'usage_room';
    protected $primaryKey = 'id';

    protected $fillable = [
        'label',
    ];
}
