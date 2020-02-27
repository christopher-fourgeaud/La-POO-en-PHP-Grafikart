<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/starter-template/">

    <title><?= App::getInstance()->title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Accueil</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="?p=users.login">Login</a></li>
                <li><a href="?p=admin.posts.index">admin.articles</a></li>
                <li><a href="?p=admin.categories.index">admin.categories</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="starter-template" style="padding-top: 100px">
            <?= $content; ?>
        </div>
    </div><!-- /.container -->

</body>

</html>