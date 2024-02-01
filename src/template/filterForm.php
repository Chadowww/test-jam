<?php

use App\Repository\BookRepository;
use App\Service\ConnectionDbService;

$filterIcon = file_get_contents('icon/filterIcon.svg');

// on crée le formulaire de filtre
$form = phpQuery::newDocument('<form class="filter" method="post"><form>');

// on crée une div pour le header du formulaire qu'on ajoute au formulaire
$form['.filter']->append('<div class="filter-header"><h2>Filtrer</h2><button type="button" class="filter-button">' . $filterIcon . '</button></div>');

// on crée un conteneur pour le body du formulaire
$formBody = $form[".filter"]->append('<div class="filter-body"></div>');

// on crée un conteneur pour le footer du formulaire
$formFooter = $form[".filter"]->append('<div class="filter-footer"></div>');

// on crée un conteneur pour les checkbox des auteurs
$authorContainer = phpQuery::newDocument('<div id="author_checkboxes" class="checkbox-container"></div>');

// on crée un conteneur pour les checkbox des genres
$genderContainer = phpQuery::newDocument('<div id="gender_checkboxes" class="checkbox-container"></div>');


// pour chaque auteurs on crée une checkbox qu'on ajoute au conteneur des checkbox des auteurs
foreach ($authors as $author) {
    $divAuthor = phpQuery::newDocument('<div class="checkbox element-author"></div>');

    $authorCheckbox = '<input type="checkbox" id="author_' . $author->getId() . '" name="authors[]" value="' . $author->getId() . '"><label for="author_' . $author->getId() . '">' . $author->getName() . '</label>';

    $divAuthor[".element-author"]->append($authorCheckbox);
    $authorContainer["#author_checkboxes"]->append($divAuthor);
}

// pour chaque genres on crée une checkbox qu'on ajoute au conteneur des checkbox des genres
foreach ($genders as $gender) {
    $divGender = phpQuery::newDocument('<div class="checkbox element-gender"></div>');
    $genderCheckbox = '<input type="checkbox" id="gender_' . $gender->getId() . '" name="genders[]" value="' . $gender->getId() . '"><label for="gender_' . $gender->getId() . '">' .$gender->getGenderName() . '</label>';
    $divGender[".element-gender"]->append($genderCheckbox);

    $genderContainer["#gender_checkboxes"]->append($divGender);
}

// on ajoute les conteneurs des checkbox des auteurs et des genres au body du formulaire
$formBody[".filter-body"]->append($authorContainer);
$formBody[".filter-body"]->append($genderContainer);
// on ajoute les boutons de validation et de réinitialisation au footer du formulaire
$formFooter[".filter-footer"]->append('<button type="submit">Filter</button>');
$formFooter[".filter-footer"]->append('<button type="reset">Réinitialiser</button>');

echo $form;