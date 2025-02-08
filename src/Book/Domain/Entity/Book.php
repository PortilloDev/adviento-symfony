<?php

    namespace App\Book\Domain\Entity;

class Book
{
    private int $id;
    public function __construct(
        private string $title,
        private string $author,
        private int $pages,
    )
    {}

    /**
     * @return string
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    /**
     * @param int|null $pages
     */
    public function setPages(?int $pages): void
    {
        $this->pages = $pages;
    }




}