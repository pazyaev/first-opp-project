<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;
use MyProject\Exceptions\InvalidArgumentException;

class Comment extends ActiveRecordEntity
{
    /** @var string */
    protected $authorId;

    /** @var string */
    protected $articleId;

    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'comments';
    }

    public function getText(): string 
    {
        return $this->text;
    }

    public function getDate(): string 
    {
        return $this->createdAt;
    }

    public function setAuthor(User $user): void
    {
        $this->authorId = $user->getId();
    }

    public function setArticle(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function setText(string $text): string
    {
        return $this->text = $text;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    } 

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public static function createFromArray(array $fields, int $articleId, User $user): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $comment = new Comment();

        $comment->setAuthor($user);
        $comment->setArticle($articleId);
        $comment->setText($fields['text']);

        $comment->save();

        return $comment;
    }

    public function updateFromArray(array $fields): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }
        
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }
}