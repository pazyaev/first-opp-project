<?php
/**
 * @var \MyProject\Models\Commenta\Comment $comment
 */
include __DIR__ . '/../header.php';
?>
<h2>Редактирование комментария</h2>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<form action="/CommentsController/edit?articleId=<?= $article->getId() ?>&commentId=<?= $comment->getId() ?>" method="post">
    <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $comment->getText() ?></textarea><br>
    <br>
    <input type="submit" value="Добавить">
</form>

<?php include __DIR__ . '/../footer.php'; ?>