<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Valid;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @Uploadable
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Category $category;

    #[ORM\Column(type: Types::INTEGER)]
    #[GreaterThan(0)]
    private int $price;

    #[ORM\Column(type: Types::FLOAT, precision: 5, scale: 4)]
    #[GreaterThan(0)]
    private float $tax;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * @UploadableField(mapping="products", fileNameProperty="image")
     */
    private ?File $file = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: FeatureValue::class, cascade: ['persist'], orphanRemoval: true)]
    #[Count(1)]
    #[Valid]
    private Collection $features;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->features = new ArrayCollection();
        $this->updatedAt = new DateTimeImmutable();
    }

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
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setTax(float $tax): self
    {
        $this->tax = $tax;
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

    /**
     * @return Collection<int, FeatureValue>
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    public function addFeature(FeatureValue $feature): self
    {
        if (!$this->features->contains($feature)) {
            $this->features[] = $feature;
            $feature->setProduct($this);
            $this->updatedAt = new DateTimeImmutable();
        }

        return $this;
    }

    public function removeFeature(FeatureValue $feature): self
    {
        if ($this->features->removeElement($feature)) {
            if ($feature->getProduct() === $this) {
                $feature->setProduct(null);
                $this->updatedAt = new DateTimeImmutable();
            }
        }

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
