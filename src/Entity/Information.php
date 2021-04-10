<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InformationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InformationRepository::class)
 * @ApiResource()
 */
class Information
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:roadbook"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:roadbook"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Un nom est obligatoire")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Groups({"read:roadbook"})
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Un téléphone est obligatoire")
     */
    private ?string $phone;

    /**
     * @ORM\ManyToOne(targetEntity=Roadbook::class, inversedBy="informations")
     */
    private ?Roadbook $roadbook;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
}
