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

    #[ORM\Column(length: 255)]
    private ?string $nomStage = null;

    #[ORM\Column]
    private ?int $nbMangeantMidi = null;

    #[ORM\Column]
    private ?int $nbMangeantSoir = null;

    #[ORM\Column]
    private ?int $semaine = null;


    public function __construct()
    {

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

    public function getSemaine(): ?int
    {
        return $this->semaine;
    }

    public function setSemaine(int $semaine): self
    {
        $this->semaine = $semaine;

        return $this;
    }


}
