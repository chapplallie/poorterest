
<!-- remplis form avec les infos du medias qu'on veux editer -->

<form action="{{ route('todo_store') }}" method="post">
    @csrf
    <label className="block text-sm font-medium text-gray-700 mb-2">Nom :</label>
    <Input 
        type="text" 
        name="name"
    />

    <label className="block text-sm font-medium text-gray-700 mb-2">Description (optionel) :</label>
    <Input 
        type="text" 
        name="description"
    />

    <label className="block text-sm font-medium text-gray-700 mb-2">url de l'image ou de la vidéo :</label>
    <Input 
        type="text" 
        name="media"
    />

    <label className="block text-sm font-medium text-gray-700 mb-2">taille de l'image :</label>
    <div>
        <input type="radio" id="small" name="drone" value="small" checked />
        <label for="small">petite</label>
    </div>

    <div>
        <input type="radio" id="medium" name="drone" value="medium" />
        <label for="medium">moyenne</label>
    </div>

    <div>
        <input type="radio" id="large" name="drone" value="large" />
        <label for="large">grande</label>
    </div>
    <label className="block text-sm font-medium text-gray-700 mb-2">catégorie :</label>
    <Input 
        type="text" 
        name="category"
    />

    <button type="submit">Envoyer</button>
</form>
