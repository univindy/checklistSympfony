<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]

    private ?string $fistname = null;

    #[ORM\Column(length: 255, nullable: true)]

    private ?string $lastname = null;

    #[ORM\Column(length: 255)]

    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Task::class)]
    private Collection $Task;

    #[ORM\OneToMany(mappedBy: 'Auteur', targetEntity: Task::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->Task = new ArrayCollection();
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFistname(): ?string
    {
        return $this->fistname;
    }

    public function setFistname(?string $fistname): self
    {
        $this->fistname = $fistname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTask(): Collection
    {
        return $this->Task;
    }

    public function addTask(Task $task): self
    {
        if (!$this->Task->contains($task)) {
            $this->Task->add($task);
            $task->setUsers($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->Task->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getUsers() === $this) {
                $task->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }
}
