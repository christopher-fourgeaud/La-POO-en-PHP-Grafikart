<?php

use App\Table\Article;
use App\Table\Categorie;

?>
<div class="row">
    <div class="col-sm-8">
        <?php foreach (Article::getAllArticles() as $post) : ?>
            <h2>
                <a href="<?= $post->getUrl() ?>"><?= $post->titre ?></a>
            </h2>

            <p>
                <em><?= $post->categorie ?></em>
            </p>

            <p>
                <?= $post->getExtrait() ?>
            </p>
        <?php endforeach ?>
    </div>

    <div class="col-sm-4">
        <ul>
            <?php foreach (Categorie::getAll() as $categorie) : ?>
                <li><a href="<?= $categorie->getUrl() ?>"><?= $categorie->titre ?></a></li>

            <?php endforeach ?>
        </ul>
    </div>
</div>