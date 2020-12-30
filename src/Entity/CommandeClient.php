<?php

namespace App\Entity;

use App\Repository\CommandeClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeClientRepository::class)
 */
class CommandeClient
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
    private $bonCommandeClient;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCommandeClient;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLivraisonClient;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="CommandeClient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeReglement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numFacture;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonCommandeClient(): ?string
    {
        return $this->bonCommandeClient;
    }

    public function setBonCommandeClient(string $bonCommandeClient): self
    {
        $this->bonCommandeClient = $bonCommandeClient;

        return $this;
    }

    public function getDateCommandeClient(): ?\DateTimeInterface
    {
        return $this->dateCommandeClient;
    }

    public function setDateCommandeClient(\DateTimeInterface $dateCommandeClient): self
    {
        $this->dateCommandeClient = $dateCommandeClient;

        return $this;
    }

    public function getDateLivraisonClient(): ?\DateTimeInterface
    {
        return $this->dateLivraisonClient;
    }

    public function setDateLivraisonClient(\DateTimeInterface $dateLivraisonClient): self
    {
        $this->dateLivraisonClient = $dateLivraisonClient;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }



    public function getDateDeReglement(): ?\DateTimeInterface
    {
        return $this->dateDeReglement;
    }

    public function setDateDeReglement(?\DateTimeInterface $dateDeReglement): self
    {
        $this->dateDeReglement = $dateDeReglement;

        return $this;
    }

    public function getNumFacture(): ?string
    {
        return $this->numFacture;
    }

    public function setNumFacture(?string $numFacture): self
    {
        $this->numFacture = $numFacture;

        return $this;
    }
}
