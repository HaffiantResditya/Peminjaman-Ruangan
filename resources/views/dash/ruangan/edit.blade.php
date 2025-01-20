<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 ">
        <main class="bg-white min-h-[40vh] w-full p-5">
            <div class=" mb-10">
                <p class="font-bold text-blue-500 pb-3 mt-3">Ubah Ruangan</p>
                <hr>
            </div>

            <form action="{{ route('dash.ruangan.update', ['id' => $payload->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <section class=" mb-5 mt-5">

                    <label for="">ID Ruangan</label>
                    <input type="text" name="id_ruangan" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        value="{{ old('id_ruangan') ?? $payload->room_id }}" required />
                    @error('id_ruangan')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class=" mb-5 mt-5">

                    <label for="">Nama</label>
                    <input type="text" name="nama" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        value="{{ old('nama') ?? $payload->name }}" required />
                    @error('nama')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class=" mb-5 mt-5">

                    <label for="">Kategori</label>
                    <select type="text" name="kategori" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        required>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $payload->id) selected @endif>
                                {{ $item->label }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class="
                            mb-5 mt-5">

                    <label for="">Status</label>
                    <section class="flex items-center gap-3">
                        <input type="radio" name="status" id="" placeholder=""
                            class="w-[20px] h-[20px] my-2 px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                            value="available" required @if ($payload->status == 'available') checked @endif />
                        <p>Terisi</p>
                    </section>
                    <section class="flex items-center gap-3">
                        <input type="radio" name="status" id="" placeholder=""
                            class="w-[20px] h-[20px] my-2 px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                            value="empty" required @if ($payload->status == 'empty') checked @endif />
                        <p>Kosong</p>
                    </section>
                    @error('status')
                        <div class="flex flex-row items-center mt-1 ml-2 text-red-500">
                            <p class="ml-1 text-sm font-medium ">{{ $message }}</p>
                        </div>
                    @enderror
                </section>

                <section class=" mb-5 ">

                    <label for="">Kapasitas</label>
                    <input type="number" name="kapasitas" id="" placeholder=""
                        class="w-full h-[41px] px-2 outline-blue-400 shadow-sm border border-gray-300 rounded-lg"
                        value="{{ old('kapasitas') ?? $payload->capacity }}" required />
                    @error('kapasitas')
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
