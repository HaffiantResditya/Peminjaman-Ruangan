<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 ">
        <main class="bg-white min-h-[40vh] w-full p-5">
            <div class=" mb-10">
                <p class="font-bold text-blue-500 pb-3 mt-3">Form Pengajuan Ruangan</p>
                <hr>
            </div>

            <form action="{{ route('dash.pengajuan.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $payload->id }}" name="room_id">
                <section class=" mb-5 mt-5">
                    <label for="">ID Ruangan</label>
                    <p class="font-bold text-[20px]">{{ $payload->room_id }}</p>
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Nama Ruangan</label>
                    <p class="font-bold text-[20px]">{{ $payload->name }}</p>
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required />
                    @error('waktu_mulai')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required />
                    @error('waktu_selesai')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Tanggal Pemakaian</label>
                    <input type="date" name="tanggal" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required />
                    @error('tanggal')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Perihal Penggunaan</label>
                    <select type="text" name="penggunaan" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required>
                        <option value="">Pilihan Penggunaan</option>
                        @foreach ($usage as $item)
                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>
                    @error('penggunaan')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>
                <section class=" mb-5 mt-5">

                    <label for="">Deskripsi</label>
                    <textarea type="text" name="deskripsi" id="" placeholder="Masukan Deskripsi penggunaan ruangan"
                        class="w-full px-2 h-[100px] outline-blue-400 shadow-sm border border-gray-300 rounded-lg" required></textarea>
                    @error('deskripsi')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>


                <section class="flex gap-5">
                    <button
                        class="border px-5 rounded-md bg-blue-500 h-[40px] text-white font-bold flex items-center">Submit</button>
                    <button onclick="backBtn()" type="button"
                        class="border px-5 rounded-md bg-gray-500 h-[40px] text-white font-bold flex items-center">Kembali</button>
                </section>
            </form>
        </main>
    </div>
    <script>
        function backBtn() {
            return history.back()
        }
    </script>
</x-layouts.dash>
