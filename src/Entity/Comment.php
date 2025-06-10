<?php

namespace App\Entity;

use DateTimeImmutable;

class Comment {
    private ?int $id;
    private string $content;
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $content
    ){
        $this->content = $content;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

     public function getCreatedAt(): DateTimeImmutable 
    {
        return $this->createdAt;
    }

}