<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 ">
        <main class="bg-white min-h-[40vh] w-full p-5">
            <div class=" mb-10">
                <p class="font-bold text-blue-500 mt-3">Detail Pengajuan Ruangan</p>
                <hr>
            </div>

            <form>
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

                    <label for="">Feedback Admin</label>
                    <p class="font-bold text-[20px]">{{ $payload->feedback }}</p>
                </section>
                <hr>
                <section class=" mb-5 mt-5">

                    <label for="">Status</label>
                    <p class="font-bold text-[20px]">
                        @if ($payload->status == 'accepted')
                            Diterima
                        @else
                            Ditolak
                        @endif
                    </p>
                </section>






                <section class="flex gap-5">

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
