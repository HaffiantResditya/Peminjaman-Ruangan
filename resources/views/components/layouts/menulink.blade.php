@props(['active' => false])
<a {{ $attributes }}
    class="border p-3 flex items-center {{ $active ? 'bg-blue-500 text-white' : 'text-gray-400 hover:text-gray-500' }} duration-300 rounded-md">
    {{ $slot }}
</a>
