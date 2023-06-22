<?php

namespace App\Entity;

use App\Repository\TEntrerSortieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TEntrerSortieRepository::class)
 */
class TEntrerSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TCle::class)
     * @ORM\JoinColumn(name="id_cle", referencedColumnName="id")
     */
    private $id_cle;

    /**
     * @ORM\ManyToOne(targetEntity=Tpersonnel::class)
     * @ORM\JoinColumn(name="id_personnel", referencedColumnName="id")
     */
    private $id_personnel;

    /**
     * @ORM\Column(type="date")
     */
    private $date_prise;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_sortie;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_retour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCle(): ?Tcle
    {
        return $this->id_cle;
    }

    public function setIdCle(?Tcle $id_cle): self
    {
        $this->id_cle = $id_cle;

        return $this;
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

    public function getDatePrise(): ?\DateTimeInterface
    {
        return $this->date_prise;
    }

    public function setDatePrise(\DateTimeInterface $date_prise): self
    {
        $this->date_prise = $date_prise;

        return $this;
    }

    public function getHeureSortie(): ?\DateTimeInterface
    {
        return $this->heure_sortie;
    }

    public function setHeureSortie(\DateTimeInterface $heure_sortie): self
    {
        $this->heure_sortie = $heure_sortie;

        return $this;
    }

    public function getHeureRetour(): ?\DateTimeInterface
    {
        return $this->heure_retour;
    }

    public function setHeureRetour(\DateTimeInterface $heure_retour): self
    {
        $this->heure_retour = $heure_retour;

        return $this;
    }
}
