<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailCommandeRepository::class)
 */
class DetailCommande
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
    private $quantité;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $dateService;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="detailCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_commande;

    /**
     * @ORM\ManyToOne(targetEntity=Celebrite::class)
     */
    private $id_celebrite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateService(): ?\DateTimeInterface
    {
        return $this->dateService;
    }

    public function setDateService(\DateTimeInterface $dateService): self
    {
        $this->dateService = $dateService;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commande $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdCelebrite(): ?Celebrite
    {
        return $this->id_celebrite;
    }

    public function setIdCelebrite(?Celebrite $id_celebrite): self
    {
        $this->id_celebrite = $id_celebrite;

        return $this;
    }
}
