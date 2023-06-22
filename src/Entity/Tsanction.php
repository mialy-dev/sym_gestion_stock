<?php

namespace App\Entity;

use App\Repository\TsanctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TsanctionRepository::class)
 */
class Tsanction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_sanction;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_sanction;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $duree;

    /**
     * @ORM\Column(type="text")
     */
    private $motif;

    /**
     * @ORM\OneToMany(targetEntity=Tetudiant::class, mappedBy="tsanction")
     */
    private $Etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Tpersonnel::class, mappedBy="tsanction")
     */
    private $Personnel;

    public function __construct()
    {
        $this->Etudiant = new ArrayCollection();
        $this->Personnel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSanction(): ?\DateTimeInterface
    {
        return $this->date_sanction;
    }

    public function setDateSanction(\DateTimeInterface $date_sanction): self
    {
        $this->date_sanction = $date_sanction;

        return $this;
    }

    public function getHeureSanction(): ?\DateTimeInterface
    {
        return $this->heure_sanction;
    }

    public function setHeureSanction(\DateTimeInterface $heure_sanction): self
    {
        $this->heure_sanction = $heure_sanction;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * @return Collection<int, Tetudiant>
     */
    public function getEtudiant(): Collection
    {
        return $this->Etudiant;
    }

    public function addEtudiant(Tetudiant $etudiant): self
    {
        if (!$this->Etudiant->contains($etudiant)) {
            $this->Etudiant[] = $etudiant;
            $etudiant->setTsanction($this);
        }

        return $this;
    }

    public function removeEtudiant(Tetudiant $etudiant): self
    {
        if ($this->Etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getTsanction() === $this) {
                $etudiant->setTsanction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tpersonnel>
     */
    public function getPersonnel(): Collection
    {
        return $this->Personnel;
    }

    public function addPersonnel(Tpersonnel $personnel): self
    {
        if (!$this->Personnel->contains($personnel)) {
            $this->Personnel[] = $personnel;
            $personnel->setTsanction($this);
        }

        return $this;
    }

    public function removePersonnel(Tpersonnel $personnel): self
    {
        if ($this->Personnel->removeElement($personnel)) {
            // set the owning side to null (unless already changed)
            if ($personnel->getTsanction() === $this) {
                $personnel->setTsanction(null);
            }
        }

        return $this;
    }
}
