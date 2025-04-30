<form action="{{ route('todo_store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <!-- Title -->
    <label class="block text-sm font-medium text-gray-700 mb-2">Titre :</label>
    <input 
        type="text" 
        name="title" 
        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        required 
        maxlength="90"
    />

    <!-- Description -->
    <label class="block text-sm font-medium text-gray-700 mb-2">Description (optionnel) :</label>
    <textarea 
        name="description" 
        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        rows="3"
    ></textarea>

    <!-- Media File -->
    <label class="block text-sm font-medium text-gray-700 mb-2">Fichier média (image ou vidéo) :</label>
    <input 
        type="file" 
        name="media" 
        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        accept=".jpeg,.png,.jpg,.gif,.svg,.mp4,.mov"
        required
    />

    <!-- Size -->
    <label class="block text-sm font-medium text-gray-700 mb-2">Taille de l'image :</label>
    <div>
        <input type="radio" id="small" name="size" value="small" checked />
        <label for="small">Petite</label>
    </div>
    <div>
        <input type="radio" id="medium" name="size" value="medium" />
        <label for="medium">Moyenne</label>
    </div>
    <div>
        <input type="radio" id="large" name="size" value="large" />
        <label for="large">Grande</label>
    </div>

    <!-- Category -->
    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie :</label>
    <input 
        type="text" 
        name="category" 
        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        required
    />

    <!-- Submit Button -->
    <button 
        type="submit" 
        class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        Envoyer
    </button>
</form>