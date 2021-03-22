<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StepRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 * @ApiResource()
 */
class Step
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:roadbook"})
     */
    private $stepDate;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read:roadbook"})
     */
    private $stepLat;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read:roadbook"})
     */
    private $stepLong;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:roadbook"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:roadbook"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Roadbook::class, inversedBy="steps")
     */
    private $roadbook;

    /**
     * @ORM\OneToOne(targetEntity=Suggestion::class, cascade={"persist", "remove"})
     * @Groups({"read:roadbook"})
     */
    private $suggestion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStepDate(): ?\DateTimeInterface
    {
        return $this->stepDate;
    }

    public function setStepDate(\DateTimeInterface $stepDate): self
    {
        $this->stepDate = $stepDate;

        return $this;
    }

    public function getStepLat(): ?float
    {
        return $this->stepLat;
    }

    public function setStepLat(float $stepLat): self
    {
        $this->stepLat = $stepLat;

        return $this;
    }

    public function getStepLong(): ?float
    {
        return $this->stepLong;
    }

    public function setStepLong(float $stepLong): self
    {
        $this->stepLong = $stepLong;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRoadbook(): ?Roadbook
    {
        return $this->roadbook;
    }

    public function setRoadbook(?Roadbook $roadbook): self
    {
        $this->roadbook = $roadbook;

        return $this;
    }

    public function getSuggestion(): ?Suggestion
    {
        return $this->suggestion;
    }

    public function setSuggestion(?Suggestion $suggestion): self
    {
        $this->suggestion = $suggestion;

        return $this;
    }
}
