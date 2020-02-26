<?php

use Core\HTML\BootstrapForm;

$table = App::getInstance()->getTable('Category');

if (!empty($_POST)) {
    $resultat = $table->update($_GET['id'], [
        'titre' => $_POST['titre'],

    ]);

    if ($resultat) {
?>
        <div class="alert alert-success">La catégorie à bien été modifiée</div>
<?php
    }
}

$categorie = $table->find($_GET['id']);
$form = new BootstrapForm($categorie);

?>

<form method="post">
    <?= $form->input('titre', 'Titre de la catégorie') ?>
    <?= $form->submit('Sauvegarder') ?>

</form>