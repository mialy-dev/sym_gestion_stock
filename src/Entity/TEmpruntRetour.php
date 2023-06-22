<?php

namespace App\Entity;

use App\Repository\TEmpruntRetourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TEmpruntRetourRepository::class)
 */
class TEmpruntRetour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tpersonnel::class)
     * @ORM\JoinColumn(name="id_personnel", referencedColumnName="id")
     */
    private $id_personnel;

    /**
     * @ORM\ManyToOne(targetEntity=Tstock::class)
     * @ORM\JoinColumn(name="id_stock", referencedColumnName="id")
     */
    private $id_stock;

    /**
     * @ORM\Column(type="date")
     */
    private $date_emprunt;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_emprunt;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_retour;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersonnel(): ?Tpersonnel
    {
        return $this->id_personnel;
    }

    public function setIdPersonnel(?Tpersonnel $id_personnel): self
    {
        $this->id_personnel = $id_personnel;

        return $this;
    }

    public function getIdStock(): ?Tstock
    {
        return $this->id_stock;
    }

    public function setIdStock(?Tstock $id_stock): self
    {
        $this->id_stock = $id_stock;

        return $this;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $date_emprunt): self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    public function getHeureEmprunt(): ?\DateTimeInterface
    {
        return $this->heure_emprunt;
    }

    public function setHeureEmprunt(\DateTimeInterface $heure_emprunt): self
    {
        $this->heure_emprunt = $heure_emprunt;

        return $this;
    }

    public function getHeureRetour(): ?\DateTimeInterface
    {
        return $this->heure_retour;
    }

    public function setHeureRetour(?\DateTimeInterface $heure_retour): self
    {
        $this->heure_retour = $heure_retour;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
