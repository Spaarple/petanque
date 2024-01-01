<x-app-layout>
    <form action="{{ route('admin.sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Ajoutez des champs supplémentaires pour les autres attributs --}}
        <button type="submit">Modifier</button>

        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="sponsor_name" class="block text-sm font-medium text-gray-700">Nom du Sponsor</label>
                        <input type="text" name="sponsor_name" id="sponsor_name" required value="{{ $sponsor->sponsor_name }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div>
                    <label for="sponsor_logo" class="block text-sm font-medium text-gray-700">Logo du Sponsor</label>
                    <input type="file" name="sponsor_logo" id="sponsor_logo" value="{{ $sponsor->sponsor_logo }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- display the image -->
                <div>
                    <img src="{{ asset( $sponsor->sponsor_logo) }}" alt="sponsor logo">
                </div>
                

                <div>
                    <label for="sponsor_website" class="block text-sm font-medium text-gray-700">Site Web du
                        Sponsor</label>
                    <input type="url" name="sponsor_website" id="sponsor_website" value="{{ $sponsor->sponsor_website }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="sponsor_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="sponsor_description" id="sponsor_description" rows="3"  
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ $sponsor->sponsor_description }}
                    </textarea>
                </div>

                <!-- sponsors end date -->
                <div>
                    <label for="sponsor_subscription_end_date" class="block text-sm font-medium text-gray-700">Date de
                        fin du Sponsor</label>
                    <input type="date" name="sponsor_subscription_end_date" id="sponsor_subscription_end_date" value="{{ $sponsor->sponsor_subscription_end_date }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>


                <!-- Ajoutez ici d'autres champs nécessaires -->

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Modifier</button>

            </div>
        </div>
    </form>
</x-app-layout>
