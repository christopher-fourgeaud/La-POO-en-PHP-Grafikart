<?php

$categories = App::getInstance()->getTable('Category')->all();

?>

<h1>Administrer les Categories</h1>

<p>
    <a href="?p=categories.add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $categorie) : ?>
            <tr>
                <td><?= $categorie->id ?></td>
                <td><?= $categorie->titre ?></td>
                <td>
                    <a href="?p=categories.edit&id=<?= $categorie->id ?>" class="btn btn-primary">Edit</a>
                    <form action="?p=categories.delete" method="POST" style="display: inline">
                        <input type="hidden" name="id" value="<?= $categorie->id ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>

                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>