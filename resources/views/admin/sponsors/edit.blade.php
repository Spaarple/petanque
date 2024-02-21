<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le sponsor
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
            <form action="{{ route('admin.sponsors.update', $sponsor->id) }}" method="PUT" enctype="multipart/form-data">

                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="sponsor_name" class="block text-sm font-medium text-gray-700">Nom du
                                    Sponsor</label>
                                <input type="text" name="sponsor_name" id="sponsor_name" required
                                    value="{{ $sponsor->sponsor_name }}"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="sponsor_logo" class="block text-sm font-medium text-gray-700">Logo du
                                Sponsor</label>
                            <input type="file" name="sponsor_logo" id="sponsor_logo"
                                value="{{ $sponsor->sponsor_logo }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <!-- display the image -->
                        <div>
                            <img src="{{ asset($sponsor->sponsor_logo) }}" alt="sponsor logo">
                        </div>


                        <div>
                            <label for="sponsor_website" class="block text-sm font-medium text-gray-700">Site Web du
                                Sponsor</label>
                            <input type="url" name="sponsor_website" id="sponsor_website"
                                value="{{ $sponsor->sponsor_website }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="sponsor_description"
                                class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="sponsor_description" id="sponsor_description" rows="3"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ $sponsor->sponsor_description }}
                    </textarea>
                        </div>

                        <!-- sponsors end date -->
                        <div>
                            <label for="sponsor_subscription_end_date"
                                class="block text-sm font-medium text-gray-700">Date de
                                fin du Sponsor</label>
                            <input type="date" name="sponsor_subscription_end_date"
                                id="sponsor_subscription_end_date" value="{{ $sponsor->sponsor_subscription_end_date }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>


                        {{-- contact mail --}}
                        <div class="mb-4">
                            <label for="sponsor_contact_email"
                                class="block text-gray-700 text-sm font-bold mb-2">Mail:</label>
                            <input type="text" name="sponsor_contact_email" id="sponsor_contact_email"
                                value="{{ $sponsor->sponsor_contact_email }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- contact téléphone --}}
                        <div class="mb-4">
                            <label for="sponsor_contact_phone"
                                class="block text-gray-700 text-sm font-bold mb-2">Téléphone:</label>
                            <input type="text" name="sponsor_contact_phone" id="sponsor_contact_phone"
                                value="{{ $sponsor->sponsor_contact_phone }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- contact adresse --}}
                        <div class="mb-4">
                            <label for="sponsor_contact_address"
                                class="block text-gray-700 text-sm font-bold mb-2">Adresse:</label>
                            <input type="text" name="sponsor_contact_address" id="sponsor_contact_address"
                                value="{{ $sponsor->sponsor_contact_address }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- add / delete images --}}
                        <div class="mb-4">
                            <label for="photos" class="block text-gray-700 text-sm font-bold mb-2">Choisir des
                                images:</label>
                            <input type="file" name="photos[]" multiple id="photos"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- display the images with delete button --}}
                        <div class="grid grid-cols-3 gap-6">
                            @foreach ($sponsor->photos as $photo)
                                <div class="col-span-3 sm:col-span-2">
                                    <img src="{{ asset($photo->photo_path) }}" alt="sponsor photo" class="w-1/2">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                                </div>
                            @endforeach
                        </div>




                        <!-- Ajoutez ici d'autres champs nécessaires -->

                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Modifier</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
