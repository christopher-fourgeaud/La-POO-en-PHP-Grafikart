<?php

use Core\Auth\DatabaseAuth;
use Core\HTML\BootstrapForm;

if (!empty($_POST)) {
    $auth = new DatabaseAuth(App::getInstance()->getDatabase());

    if ($auth->login($_POST['username'], $_POST['password'])) {
        header('Location: admin.php');
    } else {
?>
        <div class="alert alert-danger">
            Identifiants incorrect
        </div>
<?php
    }
}

$form = new BootstrapForm($_POST);

?>

<form method="post">
    <?= $form->input('username', 'Pseudo') ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']) ?>
    <?= $form->submit('Envoyer') ?>

</form>