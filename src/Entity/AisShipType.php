<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AisShipTypeRepository::class)]
class AisShipType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Range(
            min: 1,
            max: 9,
            notInRangeMessage: 'Le type AIE doit être compris entre {{ min }} et {{ max }}',
    )]
    private ?int $aisShipType = null;

    #[ORM\Column(length: 60)]
    private ?string $libelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAisShipType(): ?int
    {
        return $this->aisShipType;
    }

    public function setAisShipType(int $aisShipType): static
    {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
