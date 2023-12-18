<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'idport', targetEntity: Navire::class)]
    private Collection $navires;

    #[ORM\OneToMany(mappedBy: 'idport', targetEntity: Escale::class, orphanRemoval: true)]
    private Collection $escales;

    public function __construct()
    {
        $this->navires = new ArrayCollection();
        $this->escales = new ArrayCollection();
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
            $navire->setIdport($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getIdport() === $this) {
                $navire->setIdport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Escale>
     */
    public function getEscales(): Collection
    {
        return $this->escales;
    }

    public function addEscale(Escale $escale): static
    {
        if (!$this->escales->contains($escale)) {
            $this->escales->add($escale);
            $escale->setIdport($this);
        }

        return $this;
    }

    public function removeEscale(Escale $escale): static
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getIdport() === $this) {
                $escale->setIdport(null);
            }
        }

        return $this;
    }
}
