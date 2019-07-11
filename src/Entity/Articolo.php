<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticoloRepository")
 * @ORM\Table()
 */
class Articolo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $codice;

    /**
     * @ORM\Column(type="string", length=254, nullable=True)
     */
    private $descrizione;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prodotto", mappedBy="articolo")
     */
    private $prodotti;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="articoli")
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $um;

    public function __construct()
    {
        $this->prodotti = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCodice()
    {
        return $this->codice;
    }

    /**
     * @param mixed $codice
     */
    public function setCodice($codice): void
    {
        $this->codice = $codice;
    }

    /**
     * @return mixed
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @param mixed $descrizione
     */
    public function setDescrizione($descrizione): void
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return mixed
     */
    public function getProdotti()
    {
        return $this->prodotti;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getUm(): ?string
    {
        return $this->um;
    }

    public function setUm(?string $um): self
    {
        $this->um = $um;

        return $this;
    }

}
