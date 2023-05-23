<?php

namespace MyProject\Controllers;

use MyProject\Models\Comments\Comment;
use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;
use MyProject\Exceptions\InvalidArgumentException;

class CommentsController extends AbstractController
{
    public function add(int $articleId): void
    {
        $article = Article::getById($articleId);

        if (!empty($_POST)) {
            try {
                $comment = Comment::createFromArray($_POST, $articleId, $this->user);
            } catch(InvalidArgumentException $e) {
                session_start();
                $_SESSION['createCommentError']= $e->getMessage();
            }
                header('Location: /ArticlesController/view?id=' . $articleId, true, 302);
        }
    }

    public function edit(int $articleId, int $commentId): void
    {
        $article = Article::getById($articleId);
        $comment = Comment::getById($commentId);
        $title = 'Редактирование';
        if (!empty($_POST)) {
            try {
                $comment->updateFromArray($_POST, $articleId, $this->user);
                header('Location: /ArticlesController/view?id=' . $articleId, true, 302);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('comments/edit.php', [
                    'error' => $e->getMessage(),
                    'article' => $article,
                    'comment' => $comment
                ]);
                return;
            }
        }

        $this->view->renderHtml('comments/edit.php', [
            'article' => $article,
            'comment' => $comment,
            'title' => $title
        ]);
    }

    public function delete(int $articleId, int $commentId): void
    {
        $comment = Comment::getById($commentId);

        if($comment === null) {
            throw new NotFoundException();
        }

        $comment->delete();

        header('Location: /ArticlesController/view?id=' . $articleId, true, 302);
    }
}