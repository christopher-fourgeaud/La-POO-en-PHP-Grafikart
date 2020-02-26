<?php

$postTable = App::getInstance()->getTable('Post');

if (!empty($_POST)) {
    $resultat = $postTable->delete($_POST['id']);

    if ($resultat) {
        header('Location: admin.php');
    }
}
