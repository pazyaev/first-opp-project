<?php foreach ($comments as $comment): ?>
    <div class="row g-0">
        <div class="col-mb-3">
            <div class="card text-start">
                <div class="card-body">
                    <h6 class="card-subtitle mb-3"><?= $comment->getAuthor()->getNickname() ?></h6>
                    <p class="card-subtitle mb-2 text-muted">дата: <?= $comment->getDate() ?></p>
                    <p class="card-text"><?= $comment->getText() ?></p>
                    <?php if ($user !== null && ($comment->getAuthor()->getId() === $user->getId() || $user->isAdmin())): ?>
                        <a class="btn btn-primary" href="/CommentsController/edit?articleId=<?= $article->getId() ?>&commentId=<?= $comment->getId() ?>">Редактировать</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>