<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 ">
        <main class="bg-white min-h-[40vh] w-full p-5">
            <div class=" mb-10">
                <p class="font-bold text-blue-500 mt-3">Form Pengajuan Ruangan</p>
                <p class=" pb-3 ">Silahkan Tanggapi pengajuan dari user</p>
                <hr>
            </div>

            <form action="{{ route('dash.pengajuan.respond', ['id' => $payload->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <section class=" mb-5 mt-5">
                    <label for="">ID Ruangan</label>
                    <p class="font-bold text-[20px]">{{ $payload->room_id }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Nama User</label>
                    <p class="font-bold text-[20px]">{{ $payload->name }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Waktu Pemakaian</label>
                    <p class="font-bold text-[20px]">{{ $payload->start_time }} - {{ $payload->end_time }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Tanggal</label>
                    <p class="font-bold text-[20px]">{{ $payload->book_date }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Perihal Pemakaian</label>
                    <p class="font-bold text-[20px]">{{ $payload->label }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Deskripsi Pemakaian</label>
                    <p class="font-bold text-[20px]">{{ $payload->desc }}</p>
                </section>
                <hr>



                <section class=" mb-5 mt-5">

                    <label for="">Deskripsi Feedback</label>
                    <textarea type="text" name="feedback" id="" placeholder="Masukan Deskripsi feedback dari admin"
                        class="w-full px-2 h-[100px] outline-blue-400 shadow-sm border border-gray-300 rounded-lg" required></textarea>
                    @error('feedback')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class=" mb-5 mt-5">

                    <label for="">Tanggapi Pengajuan </label>
                    <select type="text" name="status" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required>
                        <option value="">Pilihan Penggunaan</option>
                        <option value="accepted">Terima Pengajuan</option>
                        <option value="decline">Tolak Pengajuan</option>

                    </select>
                    @error('status')
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
