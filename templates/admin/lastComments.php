<?php include __DIR__ . '/../header.php' ?>
<h1>Список последних комментариев</h1>
<form action="/AdminController/lastCommentsView" method="post">
    <label for="amount">Кол-во комментариев:</label>
    <input type="text" name="amount" value="<?= $_POST['amount'] ?? $amount ?>">
    <input type="submit" value="Отобразить">
</form>
<?php foreach ($comments as $comment): ?>
    <h4>Автор комментария - <?= $comment->getAuthor()->getNickname() ?></h5>
    <p>Текст комментария - <?= $comment->getText() ?></p>
    <h4>дата публикации комментария: <?= $comment->getDate() ?></h4>
    <a href="/CommentsController/edit?articleId=<?= $comment->getArticleId() ?>&commentId=<?= $comment->getId() ?>">Редактировать</a>
    <a href="/CommentsController/delete?articleId=<?= $comment->getArticleId() ?>&commentId=<?= $comment->getId() ?>">Удалить</a>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>