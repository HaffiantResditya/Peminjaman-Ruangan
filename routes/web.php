<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get("/dash", [DashController::class, 'index'])->name('dash');

    // auth
    Route::post("/auth/login", [AuthController::class, 'login'])->name('login.post');

    // history
    Route::get("/dash/pengajuan/riwayat", [BookingController::class, 'history'])->name('dash.pengajuan.riwayat');
    // user profil
    Route::get("/dash/profil", [UserController::class, 'profile'])->name('dash.profil');
    Route::get("/dash/profil/ganti-password", [UserController::class, 'changePassword'])->name('dash.profil.password');
    Route::post("/dash/profil/update", [UserController::class, 'profileUpdate'])->name('dash.profile.update');
    Route::post("/dash/profil/password/update", [UserController::class, 'passwordUpdate'])->name('dash.profile.password.update');
    // role admin
    Route::middleware(isAdmin::class)->group(function () {
        // kelola mahasiswa
        Route::get("/dash/mahasiswa", [UserController::class, 'mahasiswaList'])->name('dash.mahasiswa');
        Route::get("/dash/mahasiswa/tambah", [UserController::class, 'mahasiswaAdd'])->name('dash.mahasiswa.tambah');
        Route::get("/dash/mahasiswa/ubah/{id}", [UserController::class, 'mahasiswaEdit'])->name('dash.mahasiswa.ubah');
        Route::post("/dash/mahasiswa/create", [UserController::class, 'mahasiswaCreate'])->name('dash.mahasiswa.create');
        // kelola dosen
        Route::get("/dash/dosen", [UserController::class, 'dosenList'])->name('dash.dosen');
        Route::get("/dash/dosen/tambah", [UserController::class, 'dosenAdd'])->name('dash.dosen.tambah');
        Route::get("/dash/dosen/ubah/{id}", [UserController::class, 'dosenEdit'])->name('dash.dosen.ubah');
        Route::post("/dash/dosen/create", [UserController::class, 'dosenCreate'])->name('dash.dosen.create');

        // user
        Route::get("/dash/user/delete/{id}", [UserController::class, 'userDelete'])->name('dash.user.delete');
        Route::post("/dash/user/update/{id}", [UserController::class, 'userUpdate'])->name('dash.user.update');

        // kelola ruangan
        Route::get("/dash/ruangan", [RoomController::class, 'index'])->name('dash.ruangan.index');
        Route::get("/dash/ruangan/tambah", [RoomController::class, 'add'])->name('dash.ruangan.tambah');
        Route::get("/dash/ruangan/ubah/{id}", [RoomController::class, 'edit'])->name('dash.ruangan.ubah');
        Route::post("/dash/ruangan/create", [RoomController::class, 'create'])->name('dash.ruangan.create');
        Route::post("/dash/ruangan/update/{id}", [RoomController::class, 'update'])->name('dash.ruangan.update');
        Route::get("/dash/ruangan/delete/{id}", [RoomController::class, 'delete'])->name('dash.ruangan.delete');

        // pengajuan
        Route::get("/dash/pengajuan/pemakaian-ruangan", [BookingController::class, 'waitingList'])->name('dash.pengajuan.waiting.list');
        Route::get("/dash/pengajuan/pemakaian-ruangan/{id}", [BookingController::class, 'edit'])->name('dash.pengajuan.edit');
        Route::post("/dash/pengajuan/pemakaian-ruangan/update/{id}", [BookingController::class, 'update'])->name('dash.pengajuan.respond');
    });

    // role user
    Route::middleware(isUser::class)->group(function () {
        // pengajuan
        Route::get("/dash/pengajuan", [BookingController::class, 'index'])->name('dash.pengajuan.index');
        Route::get("/dash/pengajuan/pemakaian-saya", [BookingController::class, 'pengajuan'])->name('dash.pengajuan.riwayat.saya');
        Route::get("/dash/pengajuan/pemakaian-saya/{id}", [BookingController::class, 'detail'])->name('dash.pengajuan.detail');
        Route::get("/dash/pengajuan/form/{id}", [BookingController::class, 'form'])->name('dash.pengajuan.form');
        Route::post("/dash/pengajuan/create", [BookingController::class, 'create'])->name('dash.pengajuan.create');
    });
});

require __DIR__ . '/auth.php';
