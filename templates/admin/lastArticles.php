<?php include __DIR__ . '/../header.php' ?>
<h1>Список последних новостей</h1>
<form action="/AdminController/lastArticlesView" method="post">
    <label for="amount">Кол-во статей:</label>
    <input type="text" name="amount" value="<?= $_POST['amount'] ?? $amount ?>">
    <input type="submit" value="Отобразить">
</form>
<?php foreach ($articles as $article): ?>
    <h3>Название статьи - <?= $article->getName() ?></h5>
    <h4>Автор статьи - <?= $article->getAuthor()->getNickname() ?></h5>
    <p>Текст статьи - <?= $article->getTextToPreview() ?></p>
    <h4>дата публикации статьи: <?= $article->getDate() ?></h4>
    <a href="/ArticlesController/edit?id=<?= $article->getId() ?>">Редактировать</a>
    <a href="/ArticlesController/delete?id=<?= $article->getId() ?>">Удалить</a>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>