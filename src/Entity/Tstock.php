<?php

namespace App\Entity;

use App\Repository\TstockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TstockRepository::class)
 */
class Tstock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $identification;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="date")
     */
    private $date_entrer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\ManyToOne(targetEntity=Tfamille::class)
     * @ORM\JoinColumn(name="id_famille", referencedColumnName="id")
     */
    private $id_famille;

    /**
     * @ORM\ManyToOne(targetEntity=Ttype::class)
     * @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     */
    private $id_type;

    /**
     * @ORM\ManyToOne(targetEntity=Tunite::class)
     * @ORM\JoinColumn(name="id_unite", referencedColumnName="id")
     */
    private $id_unite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(?string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateEntrer(): ?\DateTimeInterface
    {
        return $this->date_entrer;
    }

    public function setDateEntrer(\DateTimeInterface $date_entrer): self
    {
        $this->date_entrer = $date_entrer;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getIdFamille(): ?Tfamille
    {
        return $this->id_famille;
    }

    public function setIdFamille(?Tfamille $id_famille): self
    {
        $this->id_famille = $id_famille;

        return $this;
    }

    public function getIdType(): ?Ttype
    {
        return $this->id_type;
    }

    public function setIdType(?Ttype $id_type): self
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getIdUnite(): ?Tunite
    {
        return $this->id_unite;
    }

    public function setIdUnite(?Tunite $id_unite): self
    {
        $this->id_unite = $id_unite;

        return $this;
    }
}
