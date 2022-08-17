<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepasRepository::class)]
class Repas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    #[ORM\ManyToMany(targetEntity: Utilisateurs::class, inversedBy: 'repas')]
    private Collection $utilisateurs;

    #[ORM\Column(length: 255)]
    private ?string $nomStage = null;

    #[ORM\Column]
    private ?int $nbMangeantMidi = null;

    #[ORM\Column]
    private ?int $nbMangeantSoir = null;

    #[ORM\ManyToOne(inversedBy: 'StageRepas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stages $stages = null;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getIdUser(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUser(Utilisateurs $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
        }

        return $this;
    }

    public function removeUser(Utilisateurs $utilisateur): self
    {
        $this->utilisateurs->removeElement($utilisateur);

        return $this;
    }

    public function getNomStage(): ?string
    {
        return $this->nomStage;
    }

    public function setNomStage(string $nomStage): self
    {
        $this->nomStage = $nomStage;

        return $this;
    }

    public function getNbMangeantMidi(): ?int
    {
        return $this->nbMangeantMidi;
    }

    public function setNbMangeantMidi(int $nbMangeantMidi): self
    {
        $this->nbMangeantMidi = $nbMangeantMidi;

        return $this;
    }

    public function getNbMangeantSoir(): ?int
    {
        return $this->nbMangeantSoir;
    }

    public function setNbMangeantSoir(int $nbMangeantSoir): self
    {
        $this->nbMangeantSoir = $nbMangeantSoir;

        return $this;
    }

    public function getStages(): ?Stages
    {
        return $this->stages;
    }

    public function setStages(?Stages $stages): self
    {
        $this->stages = $stages;

        return $this;
    }


}
