{{-- resources/views/albums/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Albums
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $album->name }}</h2>
                <p class="text-gray-600">{{ $album->description }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($album->images as $image)
                    <div class="grid gap-4">
                        @if ($image->type == 'image')
                            <img class="h-auto max-w-full rounded-lg" src="{{ Storage::url($image->file_path) }}" alt="Image">
                        @else
                            <video class="h-auto max-w-full rounded-lg" controls src="{{ Storage::url($image->file_path) }}"></video>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
