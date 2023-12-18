<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[Assert\Unique(fields: ['imo', 'mmsi', 'indicatifAppel'])]
#[ORM\Entity(repositoryClass: NavireRepository::class)]
#[ORM\Index(name: 'ind_IMO', columns: ['imo'])]
#[ORM\Index(name: 'ind_MMSI', columns: ['mmsi'])]
class Navire {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'imo', length: 7)]
    #[Assert\Regex('[1-9][0-9]{6}', message: 'le numéro IMO doit être unique et composé de 7 chiffres sans commencer par 0')]
    private ?string $imo = null;

    #[ORM\Column(length: 60)]
    private ?string $Nom = null;

    #[ORM\Column(name: 'mmsi', length: 9)]
    #[Assert\Regex('[1-9][0-9]{8}', message: 'le numéro MMSI doit être unique et composé de 9 chiffres sans commencer par 0')]
    private ?string $MMSI = null;

    #[ORM\Column(length: 10)]
    private ?string $indicatifappel = null;

    #[ORM\Column(name: 'eta', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Eta = null;

    #[ORM\Column]
    private ?int $longueur = null;

    #[ORM\Column]
    private ?int $largeur = null;

    #[ORM\Column]
    private ?float $tirantdeau = null;

    #[ORM\ManyToOne(inversedBy: 'navires')]
    #[ORM\JoinColumn(name: 'idaisshiptype', nullable: false)]
    private ?AisShipType $aisShipType = null;

    #[ORM\ManyToOne(inversedBy: 'navires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $Pavillon = null;

    #[ORM\ManyToOne(inversedBy: 'navires', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'idport', referencedColumnName: 'id', nullable: true)]
    private ?port $destination = null;

    #[ORM\OneToMany(mappedBy: 'idnavire', targetEntity: Escale::class, orphanRemoval: true)]
    private Collection $escales;

    public function __construct()
    {
        $this->escales = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getImo(): ?string {
        return $this->imo;
    }

    public function setImo(string $imo): static {
        $this->imo = $imo;

        return $this;
    }

    public function getNom(): ?string {
        return $this->Nom;
    }

    public function setNom(string $Nom): static {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMMSI(): ?string {
        return $this->MMSI;
    }

    public function setMMSI(string $MMSI): static {
        $this->MMSI = $MMSI;

        return $this;
    }

    public function getIndicatifappel(): ?string {
        return $this->indicatifappel;
    }

    public function setIndicatifappel(string $indicatifappel): static {
        $this->indicatifappel = $indicatifappel;

        return $this;
    }

    public function getEta(): ?\DateTimeInterface {
        return $this->Eta;
    }

    public function setEta(?\DateTimeInterface $Eta): static {
        $this->Eta = $Eta;

        return $this;
    }

    public function getLongueur(): ?float {
        return $this->longueur;
    }

    public function setLongueur(float $longueur): static {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?float {
        return $this->largeur;
    }

    public function setLargeur(float $largeur): static {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantdeau(): ?float {
        return $this->tirantdeau;
    }

    public function setTirantdeau(float $tirantdeau): static {
        $this->tirantdeau = $tirantdeau;

        return $this;
    }

    public function getAisShipType(): ?AisShipType {
        return $this->aisShipType;
    }

    public function setAisShipType(?AisShipType $aisShipType): static {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    public function getPavillon(): ?Pays {
        return $this->Pavillon;
    }

    public function setPavillon(?Pays $Pavillon): static {
        $this->Pavillon = $Pavillon;

        return $this;
    }

    public function getDestination(): ?port {
        return $this->destination;
    }

    public function setDestination(?port $destination): static {
        $this->destination = $destination;

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
            $escale->setIdnavire($this);
        }

        return $this;
    }

    public function removeEscale(Escale $escale): static
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getIdnavire() === $this) {
                $escale->setIdnavire(null);
            }
        }

        return $this;
    }
}
