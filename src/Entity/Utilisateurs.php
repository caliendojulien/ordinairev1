<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 55)]
    private ?string $compagnie = null;

    #[ORM\Column]
    private ?bool $isAdmin = null;

    #[ORM\ManyToMany(targetEntity: Repas::class, mappedBy: 'utilisateur')]
    private Collection $repas;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Stages $stage = null;

    public function __construct()
    {
        $this->repas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCompagnie(): ?string
    {
        return $this->compagnie;
    }

    public function setCompagnie(string $compagnie): self
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getRepas(): Collection
    {
        return $this->repas;
    }

    public function addRepas(Repas $repa): self
    {
        if (!$this->repas->contains($repa)) {
            $this->repas->add($repa);
            $repa->addUser($this);

        }

        return $this;
    }

    public function removeRepas(Repas $repa): self
    {
        if ($this->repas->removeElement($repa)) {
            $repa->removeUser($this);
        }

        return $this;
    }

    public function getStage(): ?Stages
    {
        return $this->stage;
    }

    public function setStage(?Stages $stage): self
    {
        $this->stage = $stage;

        return $this;
    }
}
