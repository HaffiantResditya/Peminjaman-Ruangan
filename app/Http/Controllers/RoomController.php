<?php

namespace App\Http\Controllers;

use App\Models\CategoryRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->query('keyword');
        $payload = Room::where('name', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Kelola Ruangan',
            'payload' => $payload
        ];

        return view("dash.ruangan.index", $data);
    }
    public function add()
    {
        $category = CategoryRoom::all();
        $data = [
            'title' => 'Kelola Ruangan',
            'category' => $category
        ];

        return view("dash.ruangan.add", $data);
    }

    public function edit($id)
    {
        $category = CategoryRoom::all();

        $payload = Room::find($id);
        $data = [
            'title' => 'Kelola Ruangan',
            'category' => $category,
            'payload' => $payload
        ];

        return view("dash.ruangan.edit", $data);
    }

    public function create(Request $request)
    {

        $request->validate([
            'id_ruangan' => 'required|string|max:50',
            'nama' => 'required|string|max:50',
            'status' => 'required|string',
            'kapasitas' => 'required|string',
            'kategori' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'id_ruangan.required' => 'ID ruangan wajib diisi',
            'id_ruangan.string' => 'ID ruangan harus berupa string yang valid',
            'id_ruangan.max' => 'ID ruangan tidak boleh lebih dari 50 karakter',


            'status.required' => 'Status wajib diisi',
            'status.string' => 'Status harus berupa string yang valid',

            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.string' => 'Kapasitas harus berupa string yang valid',

            'kategori.required' => 'kategori wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            Room::create([
                'room_id' => $request->id_ruangan,
                'name' => $request->nama,
                'status' => $request->status,
                'capacity' => $request->kapasitas,
                'category_id' => $request->kategori,
            ]);

            DB::commit();
            Alert::success('success', 'Data Berhasil ditambahkan');
            return redirect()->route('dash.ruangan.index');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'id_ruangan' => 'required|string|max:50',
            'nama' => 'required|string|max:50',
            'status' => 'required|string',
            'kapasitas' => 'required|string',
            'kategori' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'id_ruangan.required' => 'ID ruangan wajib diisi',
            'id_ruangan.string' => 'ID ruangan harus berupa string yang valid',
            'id_ruangan.max' => 'ID ruangan tidak boleh lebih dari 50 karakter',


            'status.required' => 'Status wajib diisi',
            'status.string' => 'Status harus berupa string yang valid',

            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.string' => 'Kapasitas harus berupa string yang valid',

            'kategori.required' => 'kategori wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            $q = Room::find($id);
            if (!$q) abort(404, 'PAGE NOT FOUND');
            $q->update([
                'room_id' => $request->id_ruangan,
                'name' => $request->nama,
                'status' => $request->status,
                'capacity' => $request->kapasitas,
                'category_id' => $request->kategori,
            ]);

            DB::commit();
            Alert::success('success', 'Data Berhasil diubah');
            return redirect()->route('dash.ruangan.index');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            // Validate all event input fields
            $paket = Room::findOrFail($id);
            $paket->delete();

            Alert::success('success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            // Return back with an error message if event creation fails
            Alert::error('error', 'Gagal Menghapus Data: ' . $e->getMessage());
            return back()->with('error', 'Gagal Menghapus Data: ' . $e->getMessage());
        }
    }
}
