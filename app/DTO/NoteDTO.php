<?php

declare(strict_types=1);

namespace App\DTO;

class NoteDTO
{
    private ?int $user_id;
    private string $title;
    private string $content;
    private ?array $image;
    private ?array $file;

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param ?int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getImage(): ?array
    {
        return $this->image;
    }

    /**
     * @param ?array|null $image
     */
    public function setImage(?array $image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getFile(): ?array
    {
        return $this->file;
    }

    /**
     * @param ?array|null $file
     */
    public function setFile(?array $file): void
    {
        $this->file = $file;
    }

    public static function make(string $title, string $content, ?int $user_id = null, ?array $image = null, ?array $file = null): self
    {
        $dto = new self();

        $dto->setUserId($user_id);
        $dto->setTitle($title);
        $dto->setContent($content);
        $dto->setImage($image);
        $dto->setFile($file);

        return $dto;
    }
}
