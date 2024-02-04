<!-- if no profile photo -->
@if (!$user->profile_photo_path)
    <p>Vous n'avez pas encore de photo de profil.</p>
@else
    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"  alt="Photo de profil" class=" w-20 h-20 rounded-full">
@endif

<form action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="profile_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo de
            profil</label>
        <input type="file" name="profile_photo" id="profile_photo" class="mt-1 block w-full">
    </div>
    <div>
        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Upload</button>
    </div>
</form>
