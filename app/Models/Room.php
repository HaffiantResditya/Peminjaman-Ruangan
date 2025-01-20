<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'room_id',
        'name',
        'status',
        'capacity',
        'category_id',
    ];
}
