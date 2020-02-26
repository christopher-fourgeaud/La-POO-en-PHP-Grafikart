<?php

use Core\HTML\BootstrapForm;

$table = App::getInstance()->getTable('Category');

if (!empty($_POST)) {
    $resultat = $table->create([
        'titre' => $_POST['titre']
    ]);


    if ($resultat) {
        header('Location: admin.php?p=categories.index');
    }
}

$form = new BootstrapForm($_POST);

?>

<form method="post">
    <?= $form->input('titre', 'Titre de la catégorie') ?>
    <?= $form->submit('Sauvegarder') ?>

</form>