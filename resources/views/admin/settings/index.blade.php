<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
                <h1 class="text-2xl font-semibold text-gray-900">Paramètres</h1>
                @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mt-8">
                    <form action="{{ route('admin.settings.updateCarousel') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="carousel_images" class="block text-sm font-medium text-gray-700">Images du
                                Carousel
                                :</label>
                            <input type="file" name="carousel_images[]" multiple
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mettre à jour le Carousel
                        </button>
                    </form>
                </div>

                <!-- Affichage des images du carousel -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-900">Aperçu du Carousel</h2>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($carouselImages as $image)
                            <div class="relative group">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $image->caption }}"
                                    class="w-full h-48 object-cover rounded-md">
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-sm p-2 rounded-b-md">
                                    {{ $image->caption }}</div>
                                <!-- Bouton de suppression -->
                                <form action="{{ route('admin.settings.deleteCarouselImage', $image->id) }}"
                                    method="POST" class="absolute top-0 right-0 mt-2 mr-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Formulaire pour mettre à jour le logo -->
                <div class="mt-8">
                    <div class="logo py-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Logo Actuel</h2>
                        {{-- Assurez-vous que le chemin du logo commence par 'storage/' si vous utilisez le disque public --}}
                        <img src="{{ asset('storage/' . config('site.logo_path')) }}" alt="Logo" class="h-20">
                    </div>
                    <form action="{{ route('admin.settings.updateLogo') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo :</label>
                            <input type="file" name="logo"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mettre à jour le Logo
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
