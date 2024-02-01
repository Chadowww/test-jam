<?php
$html = phpQuery::newDocument('<ul id="book-list"></ul>');

$iconList = file_get_contents('icon/listIcon.svg');

// Créer une modale pour modifier le livre
$modal = phpQuery::pq('<div id="modal" class="modal"></div>');
$html['#book-list']->append($modal);

foreach ($books as $book) {
    // Créer le nouvel item de la liste
    $li = phpQuery::pq('<li id="li_' . $book['book_id'] . '"></li>');

    // Ajouter le titre du livre
    $li->append(sprintf('<h3>%s - %s</h3>', htmlspecialchars($book['book_id']), htmlspecialchars($book['title'])));
    $li->append($iconList);

    // Ajouter ce nouvel item à la liste de livres
    $html['#book-list']->append($li);
}

echo $html;
