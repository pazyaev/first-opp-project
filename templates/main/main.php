<?php include __DIR__ . '/../header.php'; ?>
<div class="container-fluid video">
    <div class="video">
        <iframe width="1280" height="720" src="https://www.youtube.com/embed/fJmMbl3bqE0" title="This Is DayZ - This Is Your Story" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
</div>
<div class="container main">
        <?php foreach ($articles as $article): ?>
            <div class="card mb-3" style="max-width: 1280px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <?php if ($article->getImage() !== null): ?>
                            <img src="<?= $article->getImage() ?>" class="img-fluid rounded-start" alt="snipe">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5><a class="card-title" href="/ArticlesController/view?id=<?= $article->getId() ?>"><?= $article->getName() ?></a></h5>
                            <p><?= $article->getAuthor()->getNickname() ?></p>
                            <p class="card-text text-muted"><?= $article->getTextToPreview() ?></p>
                            <?php if ($user !== null && $user->isAdmin()): ?> 
                                <a href="/ArticlesController/edit?id=<?= $article->getId() ?>" class="btn btn-primary">Редактировать</a>
                                <a href="/ArticlesController/delete?id=<?= $article->getId() ?>" class="btn btn-primary">Удалить</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
</div>
<?php include __DIR__ . '/../footer.php'; ?>