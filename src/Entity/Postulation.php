<?php

namespace App\Entity;

use App\Repository\PostulationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostulationRepository::class)]
class Postulation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postulations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidate $candidate = null;

    #[ORM\ManyToOne(inversedBy: 'postulations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JobOffer $jobOffer = null;

    #[ORM\Column]
    private ?bool $isValidate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): static
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getJobOffer(): ?JobOffer
    {
        return $this->jobOffer;
    }

    public function setJobOffer(?JobOffer $jobOffer): static
    {
        $this->jobOffer = $jobOffer;

        return $this;
    }

    public function isIsValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(bool $isValidate): static
    {
        $this->isValidate = $isValidate;

        return $this;
    }
}
