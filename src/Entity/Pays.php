<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'pays')]
#[Assert\Unique(fields: ['indicatif'])]
#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ORM\Index(name: 'ind_indicatif', columns: ['indicatif'])]
class Pays {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $Nom = null;

    #[ORM\Column(length: 3)]
    #[ORM\Regex(pattern: "/[A-Z]{3}/", message: "L'indicatif Pays a  strictement 3 caractères")]
    private ?string $Indicatif = null;

    #[ORM\OneToMany(mappedBy: 'Pavillon', targetEntity: Navire::class)]
    private Collection $navires;

    public function __construct()
    {
        $this->navires = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Navire>
     */
    public function getNavires(): Collection
    {
        return $this->navires;
    }

    public function addNavire(Navire $navire): static
    {
        if (!$this->navires->contains($navire)) {
            $this->navires->add($navire);
            $navire->setPavillon($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getPavillon() === $this) {
                $navire->setPavillon(null);
            }
        }

        return $this;
    }
}
