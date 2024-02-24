# API d'upload d'images

## Installation
1. Remplacer l'ancien API par celui-ci (supprimer le dossier `public/api`).
2. Remettre les bonnes infos pour la base de données dans le fichier `index.php`
3. Au besoin, ajuster la fonction `traiterFiles()` dans le fichier `index.php` pour avoir les bon formats d'images.
    > ### Pour changer les formats
    > L'instruction suivante détermine dans quel dossier sera déposés les fichiers créé.
    > ```php
    > Output::$default_folder = "/img/" . $table;
    > ```
    > En l'occurence, les images seront déposés dans le dossier `/img/` et le nom du dossier sera le nom de la __table__ dans la base de données.
    > Ex.: `/img/joueurs/`
    >
    > L'instruction suivante détermine le format du nom des fichiers créés.
    > ```php
    > `Output::$default_pattern = "%s{name}/%d{width}x%d{height}.%s";`
    > ```
    > En l'occurence, les images seront nommés selon le format suivant: `nom_du_fichier/largeur_en_px x hauteur_en_px.extension`.
    > 
    > Pour le projet, le nom du fichier sera le id du joueur.
    > Ex.: `1/512x512.webp`
    > 
    > Au final, le fichier sera `/img/joueurs/1/512x512.webp`
    > 
    > Il est de bonne pratique de créer diverses versions d'une même image. Par exemple, une image de 512x512 px peut être réduite à 256x256 px, 128x128 px, etc. Il est aussi possible de créer des images de différents formats. Par exemple, une image devrait avoir diverses dimensions pour accomoder les diverses situations.
    > 
    > L'instruction suivante détermine le format d'une images créée.	
    > ```php
    > $image->addOutput(512, 512, "image/webp");
    > ```
    > La première valeur est la largeur de l'image, la deuxième est la hauteur et la troisième est le format de l'image.
    > 
    > L'image sera redimensionnée proportionnellement à la largeur ou à la hauteur selon la plus grande valeur (cover) et sera découpée au format demandé.
    > 
    > Si on met 0 à l'une des valeurs, l'image sera redimensionnée proportionnellement à l'autre valeur.
    > 
    > Vous pouvez utiliser les valeurs données et tout simplement ignorer les fichiers non utilisés.


## Utilisation

### Joueur/Form.vue
Dans le formulaire, ajouter un élément de type `file` avec l'attribut `name` égal à `image`.

### Exemple
```html
<div>
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo" />
</div>
```
Modifier le traitement du formulaire pour envoyer un objet `FormData` au lieu de l'objet `joueur`.
```javascript
const evt = {
	submit: () => {
		emit('submit', new FormData(document.forms[0]));
	}
};
```

> ### Conseil
> Dans l'éventualité où vous ayez plusieurs formulaire dans votre page, il est de bonne pratique de nommer le formulaire et de l'appeler par son nom. Voici le code correspondant :
> ```html
> <form name="create_joueur" action="" @submit.prevent="evt.submit">
> ```
> ```javascript
> emit('submit', new FormData(document.forms.create_joueur));
> ```

### Joueur/Create.vue et Joueur/Edit.vue
Dans le traitement du formulaire, utiliser le `formData` soumis à l'événement à la place de l'objet `joueur`. 

### Exemple
```javascript
const evt = {
	submit: (formData) => {
		axios.post('http://localhost:8000/api/joueurs', formData).then((res) => {
			// Redirection ou autre
		});
	}
};
```

## Utilisation des images

Comme les fichiers sont dans le dossier public, on n'a qu'à utiliser le chemin relatif pour accéder aux images.

### Exemple
```html
<img :src="`/img/joueurs/${joueur.id}/512x512.webp`" :alt="`${joueur.prenom} ${joueur.nom}`" />
```

