<x-layouts.dash>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex p-5 flex-wrap justify-center md:justify-between ">
        <section
            class="bg-white flex w-[95%] md:w-[48%] mb-10 shadow justify-between border-r-blue-400 border-r-[10px] h-[100px] p-5">
            <div class="w-[50px] h-[50px] bg-blue-500 text-white flex justify-center items-center rounded-full">
                <i class="fa-solid fa-building"></i>
            </div>
            <div class="text-end">
                <p class="font-bold text-blue-500">Ruangan</p>
                <p class="text-[20px] font-bold">{{ $room }}</p>
            </div>
        </section>
        <section
            class="bg-white flex  w-[95%] md:w-[48%] mb-10 shadow justify-between border-r-blue-400 border-r-[10px] h-[100px] p-5">
            <div class="w-[50px] h-[50px] bg-blue-500 text-white flex justify-center items-center rounded-full">
                <i class="fa-solid fa-shapes"></i>
            </div>
            <div class="text-end">
                <p class="font-bold text-blue-500">Riwayat</p>
                <p class="text-[20px] font-bold">{{ $history }}</p>
            </div>
        </section>
        {{-- <section
            class="bg-white flex  w-[95%] md:w-[48%] mb-10 shadow justify-between border-r-blue-400 border-r-[10px] h-[100px] p-5">
            <div class="w-[50px] h-[50px] bg-blue-500 text-white flex justify-center items-center rounded-full">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="text-end">
                <p class="font-bold text-blue-500">Pengguna</p>
                <p class="text-[20px] font-bold">{{ $user }}</p>
            </div>
        </section> --}}
    </div>
</x-layouts.dash>
