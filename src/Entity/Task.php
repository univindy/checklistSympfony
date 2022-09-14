<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TaskRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ApiResource]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Content = null;

    #[ORM\Column]
    private ?bool $Stade = null;

    #[ORM\Column]
    private ?bool $Importance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ModifiedAt = null;


    #[ORM\ManyToOne(inversedBy: 'Task')]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function isStade(): ?bool
    {
        return $this->Stade;
    }

    public function setStade(bool $Stade): self
    {
        $this->Stade = $Stade;

        return $this;
    }

    public function setImportance(bool $Importance): self
    {
        $this->Importance = $Importance;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->ModifiedAt;
    }

    public function setModifiedAt(\DateTimeImmutable $ModifiedAt): self
    {
        $this->ModifiedAt = $ModifiedAt;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function isImportance(): ?bool
    {
        return $this->Importance;
    }
}
