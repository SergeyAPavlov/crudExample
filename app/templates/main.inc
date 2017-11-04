<!DOCTYPE html>
<html>
<head>
    <title>Пример реализации CRUD с шаблоном MVC</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.js"></script>
<blockquote class="pull-right">
    <?php
    if ($logged) {
        ?>
        <h4 align="center">Вы вошли с логином <?= $login ?></h4>
    <?php } ?>
</blockquote>

<?= $content ?>
<?php
if ($logged) {
    ?>
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="#">Реализация CRUD</a>
            <ul class="nav">
                <li class="active"><a href="/">На главную</a></li>

                <li><a href=/logout>выйти</a></li>
            </ul>
        </div>
    </div>
<?php } ?>
</body>
</html>