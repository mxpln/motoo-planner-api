<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoadbookRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RoadbookRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"read:roadbook"}},
 *     denormalizationContext={"groups"={"create:roadbook"}}
 * )
 */
class Roadbook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:roadbook", "read:user-roadbooks"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create:roadbook", "read:roadbook","read:user-roadbooks"})
     * @Assert\NotBlank(message="Le titre du roadbook est obligatoire")
     * @Assert\Length(min=3, minMessage="Le titre doit faire entre 3 et 255 caractères", max=255,
     *     maxMessage="Le titre du roadbook doit faire entre 3 et 255 caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"create:roadbook", "read:roadbook","read:user-roadbooks"})
     * @Assert\NotBlank(message="La description du roadbook est obligatoire")
     * @Assert\Length(min=3, minMessage="La description doit faire entre 3 et 255 caractères", max=255,
     *     maxMessage="La description du roadbook doit faire entre 3 et 255 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"create:roadbook", "read:roadbook","read:user-roadbooks"})
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:roadbook", "read:user-roadbooks", "post_picture"})
     */
    private $pictureUrl;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"create:roadbook", "read:roadbook"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"create:roadbook", "read:roadbook"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"create:roadbook", "read:roadbook", "read:user-roadbooks"})
     * @Assert\NotBlank(message="La date de départ de la balade est obligatoire")
     */
    private $tripStart;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create:roadbook", "read:roadbook"})
     */
    private $shareLink;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="roadbooks")
     * @Groups({"read:roadbook", "create:roadbook"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Information::class, mappedBy="roadbook", cascade={"persist", "remove"})
     * @Groups({"read:roadbook"})
     */
    private $informations;

    /**
     * @ORM\OneToMany(targetEntity=Checklist::class, mappedBy="roadbook", cascade={"persist", "remove"})
     * @Groups({"read:roadbook"})
     */
    private $checklists;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="roadbook", cascade={"persist", "remove"})
     * @Groups({"read:roadbook"})
     */
    private $steps;

    public function __construct()
    {
        $this->informations = new ArrayCollection();
        $this->checklists = new ArrayCollection();
        $this->steps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): self
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTripStart(): ?DateTimeInterface
    {
        return $this->tripStart;
    }

    public function setTripStart(DateTimeInterface $tripStart): self
    {
        $this->tripStart = $tripStart;

        return $this;
    }

    public function getShareLink(): ?string
    {
        return $this->shareLink;
    }

    public function setShareLink(string $shareLink): self
    {
        $this->shareLink = $shareLink;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Information[]
     */
    public function getInformations(): Collection
    {
        return $this->informations;
    }

    public function addInformation(Information $information): self
    {
        if (!$this->informations->contains($information)) {
            $this->informations[] = $information;
            $information->setRoadbook($this);
        }

        return $this;
    }

    public function removeInformation(Information $information): self
    {
        if ($this->informations->removeElement($information)) {
            // set the owning side to null (unless already changed)
            if ($information->getRoadbook() === $this) {
                $information->setRoadbook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Checklist[]
     */
    public function getChecklists(): Collection
    {
        return $this->checklists;
    }

    public function addChecklist(Checklist $checklist): self
    {
        if (!$this->checklists->contains($checklist)) {
            $this->checklists[] = $checklist;
            $checklist->setRoadbook($this);
        }

        return $this;
    }

    public function removeChecklist(Checklist $checklist): self
    {
        if ($this->checklists->removeElement($checklist)) {
            // set the owning side to null (unless already changed)
            if ($checklist->getRoadbook() === $this) {
                $checklist->setRoadbook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Step[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRoadbook($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRoadbook() === $this) {
                $step->setRoadbook(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getTitle();
    }
}
