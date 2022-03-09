<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Stringable;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
