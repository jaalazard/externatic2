<?php

namespace App\Entity;

use App\Repository\BusinessCardCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessCardCategoryRepository::class)]
class BusinessCardCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: BusinessCard::class)]
    private Collection $businessCards;

    public function __construct()
    {
        $this->businessCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, BusinessCard>
     */
    public function getBusinessCards(): Collection
    {
        return $this->businessCards;
    }

    public function addBusinessCard(BusinessCard $businessCard): static
    {
        if (!$this->businessCards->contains($businessCard)) {
            $this->businessCards->add($businessCard);
            $businessCard->setCategory($this);
        }

        return $this;
    }

    public function removeBusinessCard(BusinessCard $businessCard): static
    {
        if ($this->businessCards->removeElement($businessCard)) {
            // set the owning side to null (unless already changed)
            if ($businessCard->getCategory() === $this) {
                $businessCard->setCategory(null);
            }
        }

        return $this;
    }
}
