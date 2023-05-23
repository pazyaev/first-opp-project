<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;
use MyProject\Models\Users\User;

class ArticlesController extends AbstractController
{
    public function view(int $id)
    {
        session_start();
            $article = Article::getById($id);
            $comments = Comment::findAllByColumn('article_id', $id);

            if ($article === null) {
                throw new NotFoundException();
            }

            $error = null;
            if (array_key_exists('createCommentError', $_SESSION)) {
                $error = $_SESSION['createCommentError'];
                unset($_SESSION['createCommentError']);
            }

            $this->view->renderHtml('articles/view.php', [
                'article' => $article,
                'title' => $article->getName(),
                'comments' => $comments,
                'error' => $error,
            ]);
    }

    public function edit(int $id): void
    {
        $article = Article::getById($id);
        $title = 'Редактирование статьи';

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Для доступа к данной страницу необходимо обладать правами администратора.');
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /ArticlesController/view?id=' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'title' => $title
        
        ]);
    }

    public function add(): void
    {
        $title = 'Добавление статьи';

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Для доступа к данной страницу необходимо обладать правами администратора.');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $_FILES, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /ArticlesController/view?id=' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php', ['title' => $title]);
    }

    public function delete(int $id): void
    {
        $article = Article::getById($id);

        if($article === null) {
            throw new NotFoundException();
        }

        $article->delete();

        header('Location: /MainController/main', true, 302);
    }
}