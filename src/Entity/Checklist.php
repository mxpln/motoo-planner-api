<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChecklistRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ChecklistRepository::class)
 * @ApiResource()
 */
class Checklist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:roadbook"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:roadbook"})
     */
    private $task;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read:roadbook"})
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity=Roadbook::class, inversedBy="checklists")
     */
    private $roadbook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

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

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }
}
