<?php

namespace App\Entity;

use App\Repository\SuivieProductionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuivieProductionRepository::class)
 */
class SuivieProduction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMiseEnProd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateQualite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRemise;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateExpedition;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLivraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMiseEnProd(): ?\DateTimeInterface
    {
        return $this->dateMiseEnProd;
    }

    public function setDateMiseEnProd(\DateTimeInterface $dateMiseEnProd): self
    {
        $this->dateMiseEnProd = $dateMiseEnProd;

        return $this;
    }

    public function getDateQualite(): ?\DateTimeInterface
    {
        return $this->dateQualite;
    }

    public function setDateQualite(?\DateTimeInterface $dateQualite): self
    {
        $this->dateQualite = $dateQualite;

        return $this;
    }

    public function getDateRemise(): ?\DateTimeInterface
    {
        return $this->dateRemise;
    }

    public function setDateRemise(?\DateTimeInterface $dateRemise): self
    {
        $this->dateRemise = $dateRemise;

        return $this;
    }

    public function getDateExpedition(): ?\DateTimeInterface
    {
        return $this->dateExpedition;
    }

    public function setDateExpedition(?\DateTimeInterface $dateExpedition): self
    {
        $this->dateExpedition = $dateExpedition;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(?\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }
}
