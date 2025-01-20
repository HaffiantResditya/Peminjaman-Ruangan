<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\UsageRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->query('keyword');
        $payload = Room::where('name', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Pengajuan Ruangan',
            'payload' => $payload
        ];

        return view("dash.pengajuan.index", $data);
    }
    public function pengajuan(Request $request)
    {
        $user = Auth::user();
        $key = $request->query('keyword');
        $payload = Booking::join('rooms', 'booking_room.room_id', 'rooms.id')
            ->join('users', 'booking_room.user_id', 'users.id')
            ->join('usage_room', 'booking_room.usage_id', 'usage_room.id')
            ->select(
                'booking_room.id',
                'rooms.room_id',
                'users.name',
                'usage_room.label',
                'booking_room.start_time',
                'booking_room.end_time',
                'booking_room.book_date',
                'booking_room.status'
            )
            ->where('rooms.room_id', 'like', "%{$key}%")
            ->orderBy('booking_room.created_at', 'desc')
            ->where('booking_room.user_id', $user->id)
            ->paginate(10);

        $data = [
            'title' => 'Pengajuan Saya',
            'payload' => $payload
        ];

        return view("dash.pengajuan.pengajuan", $data);
    }
    public function history(Request $request)
    {
        $key = $request->query('keyword');
        $payload = Booking::join('rooms', 'booking_room.room_id', 'rooms.id')
            ->join('users', 'booking_room.user_id', 'users.id')
            ->join('usage_room', 'booking_room.usage_id', 'usage_room.id')
            ->select(
                'booking_room.id',
                'rooms.room_id',
                'users.name',
                'usage_room.label',
                'booking_room.start_time',
                'booking_room.end_time',
                'booking_room.book_date',
                'booking_room.status'
            )
            ->where('rooms.room_id', 'like', "%{$key}%")
            ->orderBy('booking_room.created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Riwayat Pengajuan',
            'payload' => $payload
        ];

        return view("dash.pengajuan.history", $data);
    }
    public function waitingList(Request $request)
    {
        $key = $request->query('keyword');
        $payload = Booking::join('rooms', 'booking_room.room_id', 'rooms.id')
            ->join('users', 'booking_room.user_id', 'users.id')
            ->join('usage_room', 'booking_room.usage_id', 'usage_room.id')
            ->select(
                'booking_room.id',
                'rooms.room_id',
                'users.name',
                'usage_room.label',
                'booking_room.start_time',
                'booking_room.end_time',
                'booking_room.book_date',
                'booking_room.status'
            )
            ->where('rooms.room_id', 'like', "%{$key}%")
            ->where('booking_room.status', 'pending')
            ->orderBy('booking_room.created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Pengajuan Masuk',
            'payload' => $payload
        ];

        return view("dash.pengajuan.waiting", $data);
    }

    public function form($id)
    {

        $payload = Room::find($id);
        $usage = UsageRoom::all();
        $data = [
            'title' => 'Form Pengajuan Ruangan',
            'usage' => $usage,
            'payload' => $payload
        ];

        return view("dash.pengajuan.add", $data);
    }
    public function edit($id)
    {

        $payload = Booking::join('rooms', 'booking_room.room_id', 'rooms.id')
            ->join('users', 'booking_room.user_id', 'users.id')
            ->join('usage_room', 'booking_room.usage_id', 'usage_room.id')
            ->select(
                'booking_room.id',
                'rooms.room_id',
                'users.name',
                'usage_room.label',
                'booking_room.start_time',
                'booking_room.end_time',
                'booking_room.book_date',
                'booking_room.desc',
                'booking_room.status'
            )
            ->where('booking_room.id', $id)
            ->first();

        $data = [
            'title' => 'Form Pengajuan Ruangan',
            'payload' => $payload
        ];

        return view("dash.pengajuan.edit", $data);
    }
    public function detail($id)
    {

        $user = Auth::user();

        $payload = Booking::join('rooms', 'booking_room.room_id', 'rooms.id')
            ->join('users', 'booking_room.user_id', 'users.id')
            ->join('usage_room', 'booking_room.usage_id', 'usage_room.id')
            ->select(
                'booking_room.id',
                'rooms.room_id',
                'users.name',
                'usage_room.label',
                'booking_room.start_time',
                'booking_room.end_time',
                'booking_room.book_date',
                'booking_room.desc',
                'booking_room.status',
                'booking_room.feedback',
            )
            ->where('booking_room.id', $id)
            ->where('booking_room.user_id', $user->id)
            ->first();

        $data = [
            'title' => 'Form Pengajuan Ruangan',
            'payload' => $payload
        ];

        return view("dash.pengajuan.detail", $data);
    }

    public function create(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'room_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tanggal' => 'required',
            'penggunaan' => 'required',
            'deskripsi' => 'required|string',
        ], [
            'waktu_mulai.required' => 'Waktu Mulai wajib diisi',
            'waktu_selesai.required' => 'Waktu Selesai wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'penggunaan.required' => 'Penggunaan wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.string' => 'Deskripsi harus berupa string yang valid',
        ]);

        DB::beginTransaction();

        try {

            $user = Auth::user();
            Booking::create([
                'room_id' => $request->room_id,
                'start_time' => $request->waktu_mulai,
                'end_time' => $request->waktu_selesai,
                'book_date' => $request->tanggal,
                'usage_id' => $request->penggunaan,
                'desc' => $request->deskripsi,
                'user_id' => $user->id,
                'status' => 'pending',
            ]);

            DB::commit();
            Alert::success('success', 'Pengajuan Berhasil dibuat');
            return redirect()->route('dash.pengajuan.index');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $request->validate([
            'status' => 'required',
            'feedback' => 'required|string',
        ], [
            'status.required' => 'Status wajib diisi',
            'feedback.required' => 'Feedback wajib diisi',
            'feedback.string' => 'Feedback harus berupa string yang valid',
        ]);

        $q = Booking::find($id);
        if (!$q) abort(404, 'PAGE NOT FOUND');

        DB::beginTransaction();

        try {


            $q->update([
                'feedback' => $request->feedback,
                'status' => $request->status,
            ]);

            DB::commit();
            Alert::success('success', 'Pengajuan Berhasil ditanggapi');
            return redirect()->route('dash.pengajuan.waiting.list');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
