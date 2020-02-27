<form method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->selectInput('category_id', 'Catégorie', $categories) ?>
    <?= $form->submit('Sauvegarder') ?>

</form>