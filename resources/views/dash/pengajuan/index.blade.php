<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex flex-grow p-5 flex-1">
        <main class="bg-white min-h-[40vh] flex-1">
            <div class=" mb-10 px-5">
                <p class="font-bold text-blue-500 pb-3">Data Ruangan</p>
                <hr>
            </div>
            <div class="flex justify-end items-center gap-5 px-5">
                <section class="flex gap-2 items-center border pr-2 rounded-r-lg flex-1 lg:flex-none lg:w-[300px]">
                    <input placeholder="cari ..." type="text" name="" id="search-input"
                        style="outline: none!important;" class="border-none focus:outline-0 outline-0  flex-1"
                        id="">
                    <span class="flex h-full items-center text-[18px]"><i
                            class="fa-solid fa-magnifying-glass"></i></span>
                </section>
            </div>
            <section>
                <div class="w-[95%] mx-auto overflow-x-auto mt-5">
                    <table class="w-full text-[12px] lg:text-[16px]">
                        <tr class="h-[60px] ">
                            <th class="w-[100px] font-medium text-start ">No</th>
                            <th class="w-[300px] font-medium text-center ">ID Ruangan </th>
                            <th class="w-[300px] font-medium text-center ">Nama </th>
                            <th class="w-[300px] font-medium text-center ">Status </th>
                            <th class="w-[300px] font-medium text-center ">Aksi</th>
                        </tr>

                        @foreach ($payload as $index => $item)
                            <tr class="border h-[60px] items-center font-semibold">
                                <td class="text-center">
                                    <p class="w-full px-5">{{ $index + 1 }}</p>
                                </td>
                                <td class="text-center">
                                    <p class=" w-[100px] lg:w-full text-center">
                                        {{ $item->room_id }}</p>
                                </td>
                                <td class="text-center">
                                    <p class=" w-[200px] lg:w-full text-center">
                                        {{ $item->name }}</p>
                                </td>
                                <td class="text-center font-medium px-5">
                                    @if ($item->status == 'available')
                                        <p class="text-center rounded mx-auto p-1 w-[100px] bg-yellow-500 text-white">
                                            Terisi</p>
                                    @else
                                        <p class="text-center rounded mx-auto p-1 w-[100px] bg-green-500 text-white">
                                            Kosong</p>
                                    @endif
                                </td>
                                <td class="flex justify-center items-center gap-3 h-[60px] pr-5">
                                    <a href="{{ route('dash.pengajuan.form', ['id' => $item->id]) }}"
                                        class="] h-[35px] w-[120px] lg:w-[150px] flex justify-center items-center bg-blue-500 rounded px-2 gap-2 text-white font-medium"><i
                                            class="fa-solid fa-pen-to-square"></i> Pakai Ruangan</a>

                                </td>
                            </tr>
                        @endforeach


                    </table>
                </div>
            </section>

            <section class="my-5 px-5">
                {{ $payload->links() }}
            </section>
            @if (count($payload) == 0)
                <div class=" w-full px-5">
                    <section class="border h-[60px] items-center mx-auto flex">
                        <p class="text-gray-500 text-[12px] w-full text-center font-medium">Data Tidak Ditemukan</p>
                    </section>
                </div>
            @endif
        </main>
    </div>
    <script>
        const searchInput = document.getElementById('search-input')
        if (searchInput) {
            searchInput.addEventListener('change', function() {
                const id = setTimeout(() => {
                    const key = this.value
                    console.log(key);
                    if (key.length > 0) document.location.href = `/dash/pengajuan?keyword=${key}`
                    clearTimeout(id);
                }, 300);
            })
        }

        // delete data
        function deleteData(url) {
            Swal.fire({
                title: "Hapus Data?",
                text: "Apakah Anda Yakin , Untuk Menghapus data ini ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the deletion using AJAX
                    document.location.href = url
                }
            });
        }
    </script>
</x-layouts.dash>
