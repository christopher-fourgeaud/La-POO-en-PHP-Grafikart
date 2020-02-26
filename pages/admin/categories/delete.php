<?php

$category = App::getInstance()->getTable('Category');

if (!empty($_POST)) {
    $resultat = $category->delete($_POST['id']);

    if ($resultat) {
        header('Location: admin.php?p=categories.index');
    }
}
