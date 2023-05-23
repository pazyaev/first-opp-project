<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
    public function view()
    {

        $this->view->renderHtml('admin/view.php');
    }

    public function lastArticlesView()
    {
        $numberOfArticles = 3;
        if (!empty($_POST)) {
            $numberOfArticles = $_POST['amount'];
        }
        $articles = Article::findRequiredAmount($numberOfArticles);
        $this->view->renderHtml('admin/lastArticles.php', [
            'articles' => $articles,
            'amount' => $numberOfArticles
        ]);
    }

    public function lastCommentsView()
    {
        
        $numberOfComments = 3;
        if (!empty($_POST)) {
            $numberOfComments= $_POST['amount'];
        }
        $comments = Comment::findRequiredAmount($numberOfComments);
        $this->view->renderHtml('admin/lastComments.php', [
            'comments' => $comments,
            'amount' => $numberOfComments
        ]);
    }
}