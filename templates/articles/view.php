<?php include __DIR__ . '/../header.php'; ?>
<div class="container main">
    <?php if ($article->getImage() !== null): ?>
            <img src="<?= $article->getImage() ?>" alt="img" height = "300" width="600">
    <?php endif; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getParsedText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <?php if ($user !== null && ($article->getAuthor()->getId() === $user->getId() || $user->isAdmin())): ?>
        <a href="/ArticlesController/edit?id=<?= $article->getId() ?>">Редактировать</a>
    <?php endif; ?>
    <?php if (!empty($user)): ?>
        <?php include __DIR__ . '/../comments/add.php'; ?>
    <?php else: ?>
        <h1>Авторизируйтесь на сайте если хотите оставить комментарий</h1>
    <?php endif; ?>
</div>
<?php include __DIR__ . '/../comments/view.php'; ?>
<?php include __DIR__ . '/../footer.php'; ?>