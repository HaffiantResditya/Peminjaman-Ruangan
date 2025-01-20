<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 flex-1">
        <main class="bg-white min-h-[40vh] flex-1">
            <div class=" mb-10 px-5">
                <p class="font-bold text-blue-500 pb-3">Riwayat Pengajuan</p>
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
            <div class="w-[95%] mx-auto overflow-x-auto mt-5">
                <table class="w-full text-[12px] lg:text-[16px]">
                    <tr class="h-[60px] ">
                        <th class="w-[100px] font-medium text-start ">No</th>
                        <th class="w-[300px] font-medium text-center ">ID Ruangan </th>
                        <th class="w-[300px] font-medium text-center ">User </th>
                        <th class="w-[300px] font-medium text-center ">Waktu </th>
                        <th class="w-[300px] font-medium text-center ">Tanggal </th>
                        <th class="w-[300px] font-medium text-center ">Perihal </th>
                        <th class="w-[300px] font-medium text-center ">Status </th>
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
                                <p class=" w-[100px] lg:w-full text-center">
                                    {{ $item->name }}</p>
                            </td>
                            <td class="text-center">
                                <p class="w-[100px] lg:w-full text-center">
                                    {{ $item->start_time }} - {{ $item->end_time }}</p>
                            </td>
                            <td class="text-center">
                                <p class=" w-[100px] lg:w-full text-center">
                                    {{ $item->book_date }}</p>
                            </td>
                            <td class="text-center">
                                <p class=" w-[100px] lg:w-full text-center">
                                    {{ $item->label }}</p>
                            </td>

                            <td class="flex justify-center items-center gap-3 h-[60px] pr-3">
                                @if ($item->status == 'pending')
                                    <p
                                        class="h-[35px] flex justify-center items-center bg-blue-500 rounded px-3 gap-2 text-white font-medium">
                                        <i class="fa-solid fa-hourglass-start"></i>
                                        <span>Menunggu</span>
                                    </p>
                                @elseif($item->status == 'accepted')
                                    <p
                                        class="h-[35px] flex justify-center items-center bg-green-500 rounded px-3 gap-2 text-white font-medium">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Diterima</span>
                                    </p>
                                @else
                                    <p
                                        class="h-[35px] flex justify-center items-center bg-gray-500 rounded px-3 gap-2 text-white font-medium">
                                        <i class="fa-solid fa-xmark"></i>
                                        <span>Ditolak</span>
                                    </p>
                                @endif

                            </td>
                        </tr>
                    @endforeach


                </table>
            </div>
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
                    if (key.length > 0) document.location.href = `/dash/pengajuan/riwayat/?keyword=${key}`
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
