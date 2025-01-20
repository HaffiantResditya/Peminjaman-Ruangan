@php
    $user = Auth::user();
    $firstName = explode(' ', $user->name);
@endphp
<div class=" h-[75px] flex justify-between items-center px-5 bg-white">

    <section>
        <button id="burger-bnt"
            class="bg-grey-100 block lg:hidden border h-[40px] rounded bg-opacity-5 w-[50px] text-gray-400"><i
                class="fa-solid fa-bars"></i></button>
        <p class="font-bold hidden lg:block border-l-blue-500 border-l-[5px] pl-5">Sistem Pengelolaan Ruangan</p>
    </section>
    <section class="flex items-center gap-2 cursor-pointer">
        <section class="flex items-center hover:opacity-70" id="btn-popup-user">
            <p class="pr-2">{{ $firstName[0] }}</p>
            <i class="fa-solid fa-caret-down"></i>
        </section>
        {{-- profile --}}
        <div class=" fixed top-[70px] border w-[200px] hidden flex flex-col right-2 bg-white text-gray-500 "
            id="modal-user-header">
            <a href="{{ route('dash.profil') }}" class="hover:opacity-60 border flex-1 p-2"><span class="mr-2"><i
                        class="fa-solid fa-user-gear"></i></span>Profil</a>
            <a href="{{ route('dash.profil.password') }}" class="hover:opacity-60 border flex-1 p-2"><span
                    class="mr-2"><i class="fa-solid fa-lock"></i></span>Ganti Password</a>
            <a href="#" onclick="confirmLogout('{{ route('logout') }}')"
                class="hover:opacity-60 border flex-1 p-2"><span class="mr-2"><i
                        class="fa-solid fa-right-from-bracket"></i></span>Logout</a>
        </div>
    </section>
</div>
<script>
    // open and hide profil modal
    const userPopup = document.getElementById("modal-user-header")
    const btnPopupUser = document.getElementById("btn-popup-user")
    btnPopupUser.addEventListener("click", function(e) {
        userPopup.classList.toggle("hidden");
    })

    // confirm logout
    function confirmLogout(url) {
        Swal.fire({
            title: "Logout?",
            text: "Apakah anda Yakin untuk logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
