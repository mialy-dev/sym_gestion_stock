<?php

namespace App\Entity;

use App\Repository\TpersonnelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TpersonnelRepository::class)
 */
class Tpersonnel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Tdepartement::class)
     * @ORM\JoinColumn(name="id_departement", referencedColumnName="id")
     */
    private $id_departement;

    /**
     * @ORM\ManyToOne(targetEntity=Tsanction::class, inversedBy="Personnel")
     */
    private $tsanction;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIdDepartement(): ?Tdepartement
    {
        return $this->id_departement;
    }

    public function setIdDepartement(?Tdepartement $id_departement): self
    {
        $this->id_departement = $id_departement;

        return $this;
    }

    public function getTsanction(): ?Tsanction
    {
        return $this->tsanction;
    }

    public function setTsanction(?Tsanction $tsanction): self
    {
        $this->tsanction = $tsanction;

        return $this;
    }
}
