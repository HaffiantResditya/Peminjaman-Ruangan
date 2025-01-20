<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $user = User::count();
        $room = Room::count();
        $history = Booking::count();
        $data = [
            'title' => "Dashboard",
            'user' => $user,
            'room' => $room,
            'history' => $history
        ];
        return view("dash.index", $data);
    }
}
