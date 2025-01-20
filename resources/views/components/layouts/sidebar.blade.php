@php
    $user = Auth::user();
@endphp
<div
    class=" bg-white h-[100vh] duration-500 hidden lg:ml-[0] w-[100%] lg:w-[30%] lg:max-w-[400px] fixed lg:relative lg:flex flex-col items-center border">
</div>
<sidebar id="sidebar"
    class=" bg-white h-[100vh] duration-500 ml-[-100%] lg:ml-[0] w-[100%] lg:w-[30%] lg:max-w-[400px] fixed flex flex-col items-center border">
    <section class=" h-[150px] w-full flex items-center justify-center">
        <img class="w-[75px]" src="{{ asset('assets/img/logo-app.jpeg') }}" alt="">
    </section>
    <section class=" flex-1 w-full px-5 flex flex-col gap-3 mt-5">

        <x-layouts.menulink href="{{ route('dash') }}" :active="request()->is('dash')">
            <div class="text-center w-[40px]"><i class="fa-solid fa-house"></i></div>
            <span class="ml-3">Beranda</span>
        </x-layouts.menulink>
        @if ($user->role == 'admin')
            <x-layouts.menulink href="{{ route('dash.mahasiswa') }}" :active="request()->is('dash/mahasiswa') || request()->is('dash/mahasiswa/*')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-user"></i></div>
                <span class="ml-3">Kelola Mahasiswa</span>
            </x-layouts.menulink>
            <x-layouts.menulink href="{{ route('dash.dosen') }}" :active="request()->is('dash/dosen') || request()->is('dash/dosen/*')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-user-graduate"></i></div>
                <span class="ml-3">Kelola Dosen</span>
            </x-layouts.menulink>
            <x-layouts.menulink href="{{ route('dash.ruangan.index') }}" :active="request()->is('dash/ruangan') || request()->is('dash/ruangan/*')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-building"></i></div>
                <span class="ml-3">Ruangan</span>
            </x-layouts.menulink>
            <x-layouts.menulink href="{{ route('dash.pengajuan.waiting.list') }}" :active="request()->is('dash/pengajuan/pemakaian-ruangan')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-building"></i></div>
                <span class="ml-3">Pengajuan</span>
            </x-layouts.menulink>
        @endif
        @if ($user->role == 'dosen' || $user->role == 'mahasiswa')
            <x-layouts.menulink href="{{ route('dash.pengajuan.index') }}" :active="request()->is('dash/pengajuan') || request()->is('dash/pengajuan/form/*')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-building"></i></div>
                <span class="ml-3">Ruangan</span>
            </x-layouts.menulink>
            <x-layouts.menulink href="{{ route('dash.pengajuan.riwayat.saya') }}" :active="request()->is('dash/pengajuan/pemakaian-saya') ||
                request()->is('dash/pengajuan/pemakaian-saya/*')">
                <div class="text-center w-[40px]"><i class="fa-solid fa-building"></i></div>
                <span class="ml-3">Pengajuan</span>
            </x-layouts.menulink>
        @endif
        <x-layouts.menulink href="{{ route('dash.pengajuan.riwayat') }}" :active="request()->is('dash/pengajuan/riwayat') || request()->is('dash/pengajuan/riwayat/*')">
            <div class="text-center w-[40px]"><i class="fa-solid fa-shapes"></i></div>
            <span class="ml-3">Riwayat</span>
        </x-layouts.menulink>
        <button id="menu-close" class="text-[40px] block lg:hidden opacity-40 mt-5">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
    </section>
</sidebar>
