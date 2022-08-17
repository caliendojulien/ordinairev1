<?php

namespace App\Entity;

use App\Repository\StagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagesRepository::class)]
class Stages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'stage', targetEntity: Utilisateurs::class)]
    private Collection $user;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbStagiaire = null;

    #[ORM\OneToMany(mappedBy: 'stages', targetEntity: Repas::class)]
    private Collection $StageRepas;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->StageRepas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Utilisateurs>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Utilisateurs $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setStage($this);
        }

        return $this;
    }

    public function removeUser(Utilisateurs $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getStage() === $this) {
                $user->setStage(null);
            }
        }

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbStagiaire(): ?int
    {
        return $this->nbStagiaire;
    }

    public function setNbStagiaire(?int $nbStagiaire): self
    {
        $this->nbStagiaire = $nbStagiaire;

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getStageRepas(): Collection
    {
        return $this->StageRepas;
    }

    public function addStageRepa(Repas $stageRepa): self
    {
        if (!$this->StageRepas->contains($stageRepa)) {
            $this->StageRepas->add($stageRepa);
            $stageRepa->setStages($this);
        }

        return $this;
    }

    public function removeStageRepa(Repas $stageRepa): self
    {
        if ($this->StageRepas->removeElement($stageRepa)) {
            // set the owning side to null (unless already changed)
            if ($stageRepa->getStages() === $this) {
                $stageRepa->setStages(null);
            }
        }

        return $this;
    }
}
