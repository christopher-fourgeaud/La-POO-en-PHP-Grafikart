<?php

use Core\HTML\BootstrapForm;

$postTable = App::getInstance()->getTable('Post');

if (!empty($_POST)) {
    $resultat = $postTable->update($_GET['id'], [
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']

    ]);

    if ($resultat) {
?>
        <div class="alert alert-success">L'article à bien été modifié</div>
<?php
    }
}

$post = $postTable->find($_GET['id']);
$categories = App::getInstance()->getTable('Category')->extract('id', 'titre');
$form = new BootstrapForm($post);

?>

<form method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->selectInput('category_id', 'Catégorie', $categories) ?>
    <?= $form->submit('Sauvegarder') ?>

</form>