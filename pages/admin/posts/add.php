<?php

use Core\HTML\BootstrapForm;

$postTable = App::getInstance()->getTable('Post');

if (!empty($_POST)) {
    $resultat = $postTable->create([
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']

    ]);


    if ($resultat) {
        header('Location: admin.php?p=posts.edit&id=' . App::getInstance()->getDatabase()->lastId());
    }
}

$categories = App::getInstance()->getTable('Category')->extract('id', 'titre');
$form = new BootstrapForm($_POST);

?>

<form method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->selectInput('category_id', 'Catégorie', $categories) ?>
    <?= $form->submit('Sauvegarder') ?>

</form>