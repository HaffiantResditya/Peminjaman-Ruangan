<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function mahasiswaList(Request $request)
    {
        $key = $request->query('keyword');
        $payload = User::where("role", 'mahasiswa')
            ->where('name', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Kelola Mahasiswa',
            'payload' => $payload
        ];

        return view("dash.user.mahasiswa.index", $data);
    }
    public function mahasiswaAdd()
    {
        $data = [
            'title' => 'Kelola Mahasiswa',
        ];

        return view("dash.user.mahasiswa.add", $data);
    }
    public function mahasiswaEdit($id)
    {
        $payload = User::find($id);
        $data = [
            'title' => 'Kelola Mahasiswa',
            'payload' => $payload
        ];

        return view("dash.user.mahasiswa.edit", $data);
    }
    public function dosenList(Request $request)
    {
        $key = $request->query('keyword');
        $payload = User::where("role", 'dosen')
            ->where('name', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'title' => 'Kelola Dosen',
            'payload' => $payload
        ];

        return view("dash.user.dosen.index", $data);
    }
    public function dosenAdd()
    {
        $data = [
            'title' => 'Kelola Dosen',
        ];

        return view("dash.user.dosen.add", $data);
    }
    public function dosenEdit($id)
    {
        $payload = User::find($id);
        $data = [
            'title' => 'Kelola Dosen',
            'payload' => $payload
        ];

        return view("dash.user.dosen.edit", $data);
    }
    public function dosenCreate(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8', // password confirmation rule
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Harap masukkan alamat email yang valid',
            'email.unique' => 'Email ini sudah terdaftar',

            'no_hp.required' => 'Nomor telepon wajib diisi',
            'no_hp.string' => 'Nomor telepon harus berupa string yang valid',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',

            'password.required' => 'Kata sandi wajib diisi',
            'password.min' => 'Kata sandi harus terdiri dari minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
                'password' => Hash::make($request->password),
                "role" => 'dosen'
            ]);

            DB::commit();
            Alert::success('success', 'Data Berhasil ditambahkan');
            return redirect()->route('dash.dosen');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function mahasiswaCreate(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8', // password confirmation rule
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Harap masukkan alamat email yang valid',
            'email.unique' => 'Email ini sudah terdaftar',

            'no_hp.required' => 'Nomor telepon wajib diisi',
            'no_hp.string' => 'Nomor telepon harus berupa string yang valid',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',

            'password.required' => 'Kata sandi wajib diisi',
            'password.min' => 'Kata sandi harus terdiri dari minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
                'password' => Hash::make($request->password),
                "role" => 'mahasiswa'
            ]);

            DB::commit();
            Alert::success('success', 'Data Berhasil ditambahkan');
            return redirect()->route('dash.mahasiswa');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function userUpdate(Request $request, $id)
    {

        $user = User::find($id);
        if (!$user) abort(404, 'PAGE NOT FOUND');
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Harap masukkan alamat email yang valid',
            'email.unique' => 'Email ini sudah terdaftar',

            'no_hp.required' => 'Nomor telepon wajib diisi',
            'no_hp.string' => 'Nomor telepon harus berupa string yang valid',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',

        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
            ]);

            DB::commit();
            Alert::success('success', 'Data Berhasil diubah');
            if ($request->type == 'mahasiswa')
                return redirect()->route('dash.mahasiswa');
            if ($request->type == 'dosen')
                return redirect()->route('dash.dosen');
            return redirect()->route('dash');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function profileUpdate(Request $request)
    {

        $auth =  Auth::user();
        $user = User::find($auth->id);
        if (!$user) abort(404, 'PAGE NOT FOUND');
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa string yang valid',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Harap masukkan alamat email yang valid',
            'email.unique' => 'Email ini sudah terdaftar',

            'no_hp.required' => 'Nomor telepon wajib diisi',
            'no_hp.string' => 'Nomor telepon harus berupa string yang valid',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',

        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
            ]);

            DB::commit();
            Alert::success('success', 'Profil Berhasil diubah');
            return redirect()->route('dash');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function passwordUpdate(Request $request)
    {

        $auth =  Auth::user();
        $user = User::find($auth->id);
        if (!$user) abort(404, 'PAGE NOT FOUND');
        // Validate input
        $request->validate(
            [
                'password_lama' => 'required|string',
                'password' => 'required|string|min:8', // Confirm password
            ],
            [
                'password_lama.required' => 'Password lama wajib diisi',
                'password.required' => 'Password Baru wajib diisi',
                'password.min:8' => 'Password harus minimal 8 karakter',
            ]
        );

        // Retrieve the user by ID
        $user = Auth::user();
        $query = User::findOrFail($user->id);

        // check old password
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password lama anda salah']);
        }
        DB::beginTransaction();

        try {
            // update password
            $query->password = Hash::make($request->password);
            $query->save();

            DB::commit();
            Alert::success('success', 'Password Berhasil diubah');
            return redirect()->route('dash');
        } catch (\Exception $e) {

            DB::rollBack();
            Alert::error('error', 'Terjadi Kesalahan : ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $payload = User::find($user->id);
        $data = [
            'title' => 'Profil',
            'payload' => $payload
        ];

        return view("dash.user.profil.profil", $data);
    }
    public function changePassword()
    {
        $data = [
            'title' => 'Ganti Password',
        ];

        return view("dash.user.profil.change-pass", $data);
    }

    public function userDelete($id)
    {
        try {
            // Validate all event input fields
            $paket = User::findOrFail($id);
            $paket->delete();

            Alert::success('success', 'User berhasil dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            // Return back with an error message if event creation fails
            Alert::error('error', 'Gagal Menghapus Data: ' . $e->getMessage());
            return back()->with('error', 'Gagal Menghapus Data: ' . $e->getMessage());
        }
    }
}
