{{-- resources/views/albums/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $album->name }}</h2>
                <p class="text-gray-600">{{ $album->description }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($album->images as $image)
                    <div class="rounded overflow-hidden shadow-lg relative">
                        @if ($image->type == 'image')
                            <img class="w-full" src="{{ Storage::url($image->file_path) }}" alt="Image">
                        @else
                            <video class="w-full" controls src="{{ Storage::url($image->file_path) }}"></video>
                        @endif
                        <form action="{{ route('admin.images.destroy', $image->id) }}" method="POST" class="absolute bottom-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
