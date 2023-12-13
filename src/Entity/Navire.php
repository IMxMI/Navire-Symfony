<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NavireRepository::class)]
class Navire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 7)]
    private ?string $imo = null;

    #[ORM\Column(length: 60)]
    private ?string $Nom = null;

    #[ORM\Column(length: 9)]
    private ?string $MMSI = null;

    #[ORM\Column(length: 10)]
    private ?string $indicatifappel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Eta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImo(): ?string
    {
        return $this->imo;
    }

    public function setImo(string $imo): static
    {
        $this->imo = $imo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMMSI(): ?string
    {
        return $this->MMSI;
    }

    public function setMMSI(string $MMSI): static
    {
        $this->MMSI = $MMSI;

        return $this;
    }

    public function getIndicatifappel(): ?string
    {
        return $this->indicatifappel;
    }

    public function setIndicatifappel(string $indicatifappel): static
    {
        $this->indicatifappel = $indicatifappel;

        return $this;
    }

    public function getEta(): ?\DateTimeInterface
    {
        return $this->Eta;
    }

    public function setEta(?\DateTimeInterface $Eta): static
    {
        $this->Eta = $Eta;

        return $this;
    }
}
