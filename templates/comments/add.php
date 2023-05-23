<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<form action="/CommentsController/add?articleId=<?= $article->getId() ?>" method="post">
    <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
    <br>
    <input class="btn btn-outline-secondary" type="submit" value="Добавить">
</form>