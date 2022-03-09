<?php

namespace App\Entity;

use App\Repository\FeatureValueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: FeatureValueRepository::class)]
class FeatureValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Feature::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Feature $feature;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'features')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Product $product = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank]
    private string $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeature(): Feature
    {
        return $this->feature;
    }

    public function setFeature(Feature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
