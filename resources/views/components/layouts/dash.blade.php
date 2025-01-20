<x-layouts.head>
    <x-slot:title>{{ $title }}</x-slot:title>
</x-layouts.head>
@include('sweetalert::alert')
<main class="flex">
    <x-layouts.sidebar />
    <section class="flex-1  bg-gray-50">
        <x-layouts.headbar />
        <div class="min-h-[100vh] flex flex-col ">
            {{ $slot }}
        </div>
    </section>

</main>
<x-layouts.foot />
