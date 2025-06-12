<?php

namespace App\Entity;

use App\Entity\Category;

class Post
{
    private ?int $id;
    private string $title;
    private string $content;
    private ?string $picture;
    private \DateTime $createdAt;
    private ?Category $category = null;
    private int $userId;

    public function __construct(
        string $title,
        string $content,
        ?string $picture,
        ?string $createdAt = null,
        int $userId
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->picture = $picture;
        $this->createdAt = new \DateTime($createdAt ?? 'now');
        $this->userId = $userId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }


    public function setCreatedAt(string $datetime): void
    {
        $this->createdAt = new \DateTime($datetime);
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt->format('d/m/Y H:i');
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
