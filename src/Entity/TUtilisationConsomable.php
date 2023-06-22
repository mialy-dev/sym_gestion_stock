<?php

namespace App\Entity;

use App\Repository\TUtilisationConsomableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TUtilisationConsomableRepository::class)
 */
class TUtilisationConsomable
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
     * @ORM\Column(type="integer")
     */
    private $quantite_demander;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_livrer;

    /**
     * @ORM\Column(type="date")
     */
    private $date_livraison;

    /**
     * @ORM\Column(type="text")
     */
    private $instruction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reste;

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

    public function getQuantiteDemander(): ?int
    {
        return $this->quantite_demander;
    }

    public function setQuantiteDemander(int $quantite_demander): self
    {
        $this->quantite_demander = $quantite_demander;

        return $this;
    }

    public function getQuantiteLivrer(): ?int
    {
        return $this->quantite_livrer;
    }

    public function setQuantiteLivrer(int $quantite_livrer): self
    {
        $this->quantite_livrer = $quantite_livrer;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getReste(): ?int
    {
        return $this->reste;
    }

    public function setReste(?int $reste): self
    {
        $this->reste = $reste;

        return $this;
    }
}
