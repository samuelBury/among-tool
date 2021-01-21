<?php

namespace App\Entity;

use App\Repository\ControleQualiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ControleQualiteRepository::class)
 */
class ControleQualite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numControle;

    /**
     * @ORM\Column(type="date")
     */
    private $dateControle;

    /**
     * @ORM\OneToOne(targetEntity=CommandeFournisseur::class, inversedBy="controleQualite", cascade={"persist", "remove"})
     */
    private $CommandeFournisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumControle(): ?int
    {
        return $this->numControle;
    }

    public function setNumControle(int $numControle): self
    {
        $this->numControle = $numControle;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->dateControle;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->dateControle = $date;

        return $this;
    }

    public function getCommandeFournisseur(): ?CommandeFournisseur
    {
        return $this->CommandeFournisseur;
    }

    public function setCommandeFournisseur(?CommandeFournisseur $CommandeFournisseur): self
    {
        $this->CommandeFournisseur = $CommandeFournisseur;

        return $this;
    }
}
