<?php

namespace App\Entity;

use App\Repository\EscaleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EscaleRepository::class)]
class Escale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:'dateHeureArrivee',type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeureArrive = null;

    #[ORM\Column(name: 'dateHeureDepart',type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureDepart = null;

    #[ORM\ManyToOne(inversedBy: 'escales')]
    #[ORM\JoinColumn(name:'idnavire', referencedColumnName: 'id', nullable: false)]
    private ?Navire $idnavire = null;

    #[ORM\ManyToOne(inversedBy: 'escales')]
    #[ORM\JoinColumn(name:'idport', referencedColumnName: 'id' ,nullable: false)]
    private ?port $idport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureArrive(): ?\DateTimeInterface
    {
        return $this->dateHeureArrive;
    }

    public function setDateHeureArrive(\DateTimeInterface $dateHeureArrive): static
    {
        $this->dateHeureArrive = $dateHeureArrive;

        return $this;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->dateHeureDepart;
    }

    public function setDateHeureDepart(?\DateTimeInterface $dateHeureDepart): static
    {
        $this->dateHeureDepart = $dateHeureDepart;

        return $this;
    }

    public function getIdnavire(): ?Navire
    {
        return $this->idnavire;
    }

    public function setIdnavire(?Navire $idnavire): static
    {
        $this->idnavire = $idnavire;

        return $this;
    }

    public function getIdport(): ?port
    {
        return $this->idport;
    }

    public function setIdport(?port $idport): static
    {
        $this->idport = $idport;

        return $this;
    }
}
