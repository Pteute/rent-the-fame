<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Celebrite::class, mappedBy="activites")
     */
    private $celebrites;

    public function __construct()
    {
        $this->celebrites = new ArrayCollection();
    }

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Celebrite[]
     */
    public function getCelebrites(): Collection
    {
        return $this->celebrites;
    }

    public function addCelebrite(Celebrite $celebrite): self
    {
        if (!$this->celebrites->contains($celebrite)) {
            $this->celebrites[] = $celebrite;
            $celebrite->addActivite($this);
        }

        return $this;
    }

    public function removeCelebrite(Celebrite $celebrite): self
    {
        if ($this->celebrites->removeElement($celebrite)) {
            $celebrite->removeActivite($this);
        }

        return $this;
    }
}
