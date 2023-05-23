<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= !empty($title) ? $title : 'frmst' ?></title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid background">
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/MainController/main">
            frmst
        </a>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/MainController/main">Главная</a>
            </li>
            <li class="nav-item">
                <?php if ($user !== null): ?>
                    <a class="nav-link" href="/ArticlesController/add">Добавить статью</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if ($user !== null && $user->isAdmin()): ?>
                    <a class="nav-link" href="/AdminController/view">Админка</a>
                <?php endif; ?>
            </li>
        </ul>
        <ul class="nav justify-content-end nav-pills">
            <?php if (!empty($user)): ?>
                <li class="nav-item nickname"><?= $user->getNickname() ?></li>
                <li class="nav-item"><a class="nav-link" href="/UsersController/logout">Выйти</a><li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="/UsersController/login">Войти</a></li>
                <li class="nav-item"><a class="nav-link" href="/UsersController/signUp">Зарегистрироваться</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container-fluid text-center">
