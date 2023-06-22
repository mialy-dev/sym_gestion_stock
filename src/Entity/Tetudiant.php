<?php

namespace App\Entity;

use App\Repository\TetudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TetudiantRepository::class)
 */
class Tetudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;


    /**
     * @ORM\ManyToOne(targetEntity=Tclasse::class)
     * @ORM\JoinColumn(name="id_classe", referencedColumnName="id")
     */
    private $id_classe;

    /**
     * @ORM\ManyToOne(targetEntity=Tsanction::class, inversedBy="Etudiant")
     */
    private $tsanction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
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


    public function getIdClasse(): ?Tclasse
    {
        return $this->id_classe;
    }

    public function setIdClasse(?Tclasse $id_classe): self
    {
        $this->id_classe = $id_classe;

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
