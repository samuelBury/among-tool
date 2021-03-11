<?php

namespace App\Entity;

use App\Repository\AlarmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlarmeRepository::class)
 */
class Alarme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $champApplication;

    /**
     * @ORM\Column(type="integer")
     */
    private $Delai1;

    /**
     * @ORM\Column(type="integer")
     */
    private $Delai2;

    /**
     * @ORM\Column(type="integer")
     */
    private $Delai3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $champControle;

    /**
     * @ORM\Column(type="array")
     */
    private $role = [];

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="alarmes")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChampApplication(): ?string
    {
        return $this->champApplication;
    }

    public function setChampApplication(string $champApplication): self
    {
        $this->champApplication = $champApplication;

        return $this;
    }

    public function getDelai1(): ?int
    {
        return $this->Delai1;
    }

    public function setDelai1(int $Delai1): self
    {
        $this->Delai1 = $Delai1;

        return $this;
    }

    public function getDelai2(): ?int
    {
        return $this->Delai2;
    }

    public function setDelai2(int $Delai2): self
    {
        $this->Delai2 = $Delai2;

        return $this;
    }

    public function getDelai3(): ?int
    {
        return $this->Delai3;
    }

    public function setDelai3(int $Delai3): self
    {
        $this->Delai3 = $Delai3;

        return $this;
    }

    public function getChampControle(): ?string
    {
        return $this->champControle;
    }

    public function setChampControle(string $champControle): self
    {
        $this->champControle = $champControle;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
