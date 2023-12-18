<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name:'AisShipType')]
#[ORM\Entity(repositoryClass: AisShipTypeRepository::class)]
class AisShipType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:'aisshiptype')]
    #[Assert\Range(
            min: 1,
            max: 9,
            notInRangeMessage: 'Le type AIE doit être compris entre {{ min }} et {{ max }}',
    )]
    private ?int $aisShipType = null;

    #[ORM\Column(length: 60)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'aisShipType', targetEntity: Navire::class)]
    private Collection $navires;

    #[ORM\ManyToMany(targetEntity: Port::class, mappedBy: 'types')]
    private Collection $portsCompatibles;

    public function __construct()
    {
        $this->navires = new ArrayCollection();
        $this->portsCompatibles = new ArrayCollection();
    }

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
            $navire->setAisShipType($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getAisShipType() === $this) {
                $navire->setAisShipType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Port>
     */
    public function getPortsCompatibles(): Collection
    {
        return $this->portsCompatibles;
    }

    public function addPortsCompatible(Port $portsCompatible): static
    {
        if (!$this->portsCompatibles->contains($portsCompatible)) {
            $this->portsCompatibles->add($portsCompatible);
            $portsCompatible->addType($this);
        }

        return $this;
    }

    public function removePortsCompatible(Port $portsCompatible): static
    {
        if ($this->portsCompatibles->removeElement($portsCompatible)) {
            $portsCompatible->removeType($this);
        }

        return $this;
    }
}
