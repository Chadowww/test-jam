<?php
$genderName = $book['gender_name'] ?: 'Genre non disponible';
$iconTrash = phpQuery::newDocument('<div id="trash_' . $book['book_id'] . '" class="trash">' . file_get_contents('icon/trashIcon.svg') . '</div>');

$iconClose = file_get_contents('icon/closeIcon.svg');

// Créer l'enfant de la modal avec son contenu
$modalChildren = phpQuery::newDocument('<div class="modal-content"></div>');
// Créer la corps de la modal
$modalMain = phpQuery::newDocument('<div class="modal-main"></div>');
$modalChildren[".modal-content"]->append($iconClose);

// Ajouter les détails de chaque livre dans la modal
$modalChildren[".modal-content"]->append('<h2>Titre du livre: ' . htmlspecialchars($book['title']) . '</h2>');
$modalMain[".modal-main"]->append('<p>Genre du livre: ' . htmlspecialchars($genderName) . '</p>');
$modalMain[".modal-main"]->append('<p>Publication Date: ' . htmlspecialchars($book['publication_date']) . '</p>');

// Ajouter le corps de la modal à l'enfant de la modal
$modalChildren[".modal-content"]->append($modalMain);

// Ajouter le bouton de suppression de la modal
$modalChildren[".modal-content"]->append($iconTrash);

echo $modalChildren;