<?php

namespace App\Entity;

use App\Repository\CommandeFournisseurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeFournisseurRepository::class)
 */
class CommandeFournisseur
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
    private $bonCommandeFournisseur;

    /**
     * @ORM\Column(type="date")
     */
    private $dateBonCommande;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLivraisonDonnee;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeClient::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandeClient;

    /**
     * @ORM\OneToOne(targetEntity=Fournisseur::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    /**
     * @ORM\OneToOne(targetEntity=ControleQualite::class, mappedBy="CommandeFournisseur", cascade={"persist", "remove"})
     */
    private $controleQualite;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeClient::class, inversedBy="CommandeFournisseur")
     */
    private $no;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebutProduction;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFinProduction;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRemise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonCommandeFournisseur(): ?string
    {
        return $this->bonCommandeFournisseur;
    }

    public function setBonCommandeFournisseur(string $bonCommandeFournisseur): self
    {
        $this->bonCommandeFournisseur = $bonCommandeFournisseur;

        return $this;
    }

    public function getDateBonCommande(): ?\DateTimeInterface
    {
        return $this->dateBonCommande;
    }

    public function setDateBonCommande(\DateTimeInterface $dateBonCommande): self
    {
        $this->dateBonCommande = $dateBonCommande;

        return $this;
    }

    public function getDateLivraisonDonnee(): ?\DateTimeInterface
    {
        return $this->dateLivraisonDonnee;
    }

    public function setDateLivraisonDonnee(\DateTimeInterface $dateLivraisonDonnee): self
    {
        $this->dateLivraisonDonnee = $dateLivraisonDonnee;

        return $this;
    }

    public function getCommandeClient(): ?CommandeClient
    {
        return $this->commandeClient;
    }

    public function setCommandeClient(?CommandeClient $commandeClient): self
    {
        $this->commandeClient = $commandeClient;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getControleQualite(): ?ControleQualite
    {
        return $this->controleQualite;
    }

    public function setControleQualite(?ControleQualite $controleQualite): self
    {
        $this->controleQualite = $controleQualite;

        // set (or unset) the owning side of the relation if necessary
        $newCommandeFournisseur = null === $controleQualite ? null : $this;
        if ($controleQualite->getCommandeFournisseur() !== $newCommandeFournisseur) {
            $controleQualite->setCommandeFournisseur($newCommandeFournisseur);
        }

        return $this;
    }

    public function getNo(): ?CommandeClient
    {
        return $this->no;
    }

    public function setNo(?CommandeClient $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getDateDebutProduction(): ?\DateTimeInterface
    {
        return $this->dateDebutProduction;
    }

    public function setDateDebutProduction(?\DateTimeInterface $dateDebutProduction): self
    {
        $this->dateDebutProduction = $dateDebutProduction;

        return $this;
    }

    public function getDateFinProduction(): ?\DateTimeInterface
    {
        return $this->dateFinProduction;
    }

    public function setDateFinProduction(?\DateTimeInterface $dateFinProduction): self
    {
        $this->dateFinProduction = $dateFinProduction;

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
}
