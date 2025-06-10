<?php

namespace App\Entity;

class Article {
    private ?int $id;
    private string $title;
    private string $content;
    private ?string $picture;

    public function __construct(
        string $title,
        string $content,
        ?string $picture
    ){
        $this->title = $title;
        $this->content = $content;
        $this->picture = $picture;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

     public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

    public function getPicture(): string {
        return $this->picture;
    }

    public function setPicture(string $picture): self {
        $this->picture = $picture;
        return $this;
    }

}
