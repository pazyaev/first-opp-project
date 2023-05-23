<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var string */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $img;

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function setImage(array $imgData): string
    {
        if ($imgData['name'] !== '') {
            $uploadDir = '/img';
            $name = basename($_FILES['img']['tmp_name']);
            $tmpPath = $_FILES['img']['tmp_name'];
            $uploadDir = "$uploadDir/$name";
            move_uploaded_file($tmpPath, $_SERVER['DOCUMENT_ROOT'] . $uploadDir);
        } else {
            $uploadDir = 'без картинки';
        }

        return $this->img = $uploadDir;
    }

    public function getImage(): ?string 
    {
        return $this->img;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->createdAt;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function setName(string $newName): string
    {
        return $this->name = $newName;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function setText(string $newText): string
    {
        return $this->text = $newText;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public static function createFromArray(array $fields, array $imgData, User $author): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();

        $article->setImage($imgData);
        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }

    public function getTextToPreview(): string
    {
        return mb_strimwidth($this->text, 0, 100, '...');
    }

    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }

    public function getParsedTextToPreview(): string
    {
        $parser = new \Parsedown();
        $preview = mb_strimwidth($this->getText(), 0, 100, '...');
        return $parser->text($preview);
        
    }
}