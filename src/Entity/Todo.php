<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todos
 *
 * @ORM\Table(name="todos")
 * @ORM\Entity
 */
class Todo
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var int|null
     *
     * @ORM\Column(name="completed", type="integer", nullable=true)
     */
    private $completed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCompleted(): ?int
    {
        return $this->completed;
    }

    public function setCompleted(?int $completed): self
    {
        $this->completed = $completed;

        return $this;
    }


}
