<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use App\Service\Localizable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
#[Vich\Uploadable]
/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
*/
class Candidate implements Localizable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[Vich\UploadableField(mapping: 'candidate_file', fileNameProperty: 'photo')]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: [
            'image/jpeg', 'image/png', 'image/webp',
        ],
    )]
    private ?File $photoFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cvitae = null;

    #[Vich\UploadableField(mapping: 'candidate_file', fileNameProperty: 'cvitae')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: [
            'application/pdf',
        ],
    )]
    private ?File $cvitaeFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: JobOffer::class, mappedBy: 'candidates')]
    private Collection $jobOffers;

    #[ORM\OneToOne(inversedBy: 'candidate', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'candidates')]
    private Collection $formations;

    #[ORM\OneToMany(mappedBy: 'candidates', targetEntity: Experience::class)]
    private Collection $experience;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'candidates')]
    private Collection $skills;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $mobility = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\OneToMany(mappedBy: 'candidate', targetEntity: Postulation::class)]
    private Collection $postulations;

    public function __construct()
    {
        $this->jobOffers = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->experience = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->postulations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    /**
     * @return Collection<int, JobOffer>
     */
    public function getFavorites(): Collection
    {
        return $this->jobOffers;
    }

    public function addToFavorites(JobOffer $jobOffer): static
    {
        if (!$this->jobOffers->contains($jobOffer)) {
            $this->jobOffers->add($jobOffer);
            $jobOffer->addCandidate($this);
        }

        return $this;
    }

    public function removeFromFavorites(JobOffer $jobOffer): static
    {
        if ($this->jobOffers->removeElement($jobOffer)) {
            $jobOffer->removeCandidate($this);
        }

        return $this;
    }

    public function isFavorite(JobOffer $jobOffer): bool
    {
        return in_array($jobOffer, $this->getFavorites()->toArray());
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): static
    {
        if (!$this->experience->contains($experience)) {
            $this->experience->add($experience);
            $experience->setCandidates($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        if ($this->experience->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getCandidates() === $this) {
                $experience->setCandidates(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): Candidate
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): void
    {
        $this->skills->removeElement($skill);
    }

    public function setCvitaeFile(?File $cvitae = null): Candidate
    {
        $this->cvitaeFile = $cvitae;
        if ($cvitae) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getCvitaeFile(): ?File
    {
        return $this->cvitaeFile;
    }

    public function getCvitae(): ?string
    {
        return $this->cvitae;
    }

    public function setCvitae(?string $cvitae): self
    {
        $this->cvitae = $cvitae;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function setPhotoFile(?File $photo = null): Candidate
    {
        $this->photoFile = $photo;
        if ($photo) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function getMobility(): ?int
    {
        return $this->mobility;
    }

    public function setMobility(?int $mobility): static
    {
        $this->mobility = $mobility;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->getAddress() . ', ' . $this->getCity();
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
            $postulation->setCandidate($this);
        }

        return $this;
    }

    public function removePostulation(Postulation $postulation): static
    {
        if ($this->postulations->removeElement($postulation)) {
            // set the owning side to null (unless already changed)
            if ($postulation->getCandidate() === $this) {
                $postulation->setCandidate(null);
            }
        }

        return $this;
    }
}
