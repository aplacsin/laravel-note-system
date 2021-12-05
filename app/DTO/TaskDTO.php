<?php

declare(strict_types=1);

namespace App\DTO;

class TaskDTO
{
    private int $user_id;
    private string $title;
    private int $priority;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
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
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public static function make(int $user_id, string $title, int $priority): self
    {
        $dto = new self();

        $dto->setUserId($user_id);
        $dto->setTitle($title);
        $dto->setPriority($priority);

        return $dto;
    }
}
