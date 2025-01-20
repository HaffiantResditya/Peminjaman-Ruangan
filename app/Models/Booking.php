<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking_room';
    protected $primaryKey = 'id';

    protected $fillable = [
        'room_id',
        'user_id',
        'book_date',
        'start_time',
        'end_time',
        'status',
        'desc',
        'usage_id',
        'feedback'
    ];
}
