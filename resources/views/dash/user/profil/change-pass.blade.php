<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 ">
        <main class="bg-white min-h-[40vh] w-full p-5">
            <div class=" mb-10">
                <p class="font-bold text-blue-500 pb-3">Ganti Password </p>
                <hr>
            </div>

            <form action="{{ route('dash.profile.password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="
                mb-5 mt-5">

                    <label for="">Password Lama</label>
                    <input type="password" name="password_lama" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required />
                    @error('password_lama')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>
                <section class="
                mb-5 mt-5">

                    <label for="">Password Baru</label>
                    <input type="password" name="password" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required />
                    @error('password')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class="flex gap-5">
                    <button
                        class="border px-5 rounded-md bg-blue-500 h-[40px] text-white font-bold flex items-center">Simpan</button>
                    <a href="{{ route('dash') }}"
                        class="border px-5 rounded-md bg-gray-500 h-[40px] text-white font-bold flex items-center">Kembali</a>
                </section>
            </form>
        </main>
    </div>
</x-layouts.dash>
