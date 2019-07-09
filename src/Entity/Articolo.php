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

}
