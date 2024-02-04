{{-- resources/views/user/albums/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($albums as $album)
                    <div class="rounded overflow-hidden shadow-lg">
                        @if ($album->coverImage)
                            <img class="w-full h-48 object-cover" src="{{ Storage::url($album->coverImage->file_path) }}" alt="{{ $album->name }}">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Pas d'image</span>
                            </div>
                        @endif
                        <div class="px-4 py-2">
                            <a href="{{ route('user.albums.show', $album->id) }}" class="text-lg text-indigo-600 hover:text-indigo-900 font-semibold">{{ $album->name }}</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-sm text-gray-500">Aucun album trouvé</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
