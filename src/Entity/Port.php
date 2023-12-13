<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortRepository::class)]
#[Assert\Unique(fields: ['indicatif'])]
#[ORM\Index(name: 'ind_INDICATIF', columns: ['indicatif'])]
class Port {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $Nom = null;

    #[ORM\Column(length: 5)]
    #[ORM\Regex(pattern: "/[A-Z]{5}/", message: "L'indicatif Port a strictement 6 caractères")]
    private ?string $Indicatif = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->Nom;
    }

    public function setNom(string $Nom): static {
        $this->Nom = $Nom;

        return $this;
    }

    public function getIndicatif(): ?string {
        return $this->Indicatif;
    }

    public function setIndicatif(string $Indicatif): static {
        $this->Indicatif = $Indicatif;

        return $this;
    }
}
