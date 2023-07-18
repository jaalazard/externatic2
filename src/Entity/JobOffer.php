<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use DateTime;
use App\Service\Localizable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer implements Localizable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 50)]
    private ?string $contract = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Candidate::class, inversedBy: 'jobOffers')]
    #[JoinTable(name: "favorites")]
    private Collection $candidates;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $profil = null;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'jobOffer', targetEntity: Postulation::class)]
    private Collection $postulations;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->candidates = new ArrayCollection();
        $this->postulations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(string $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Candidate>
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(Candidate $candidate): static
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates->add($candidate);
        }

        return $this;
    }

    public function removeCandidate(Candidate $candidate): static
    {
        $this->candidates->removeElement($candidate);

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): void
    {
        $this->entreprise = $entreprise;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->getCity();
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(?string $profil): static
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Postulation>
     */
    public function getPostulations(): Collection
    {
        return $this->postulations;
    }

    public function addPostulation(Postulation $postulation): static
    {
        if (!$this->postulations->contains($postulation)) {
            $this->postulations->add($postulation);
            $postulation->setJobOffer($this);
        }

        return $this;
    }

    public function removePostulation(Postulation $postulation): static
    {
        if ($this->postulations->removeElement($postulation)) {
            // set the owning side to null (unless already changed)
            if ($postulation->getJobOffer() === $this) {
                $postulation->setJobOffer(null);
            }
        }

        return $this;
    }
}
