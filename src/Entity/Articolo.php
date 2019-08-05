<?php
/**
 * Articolo base, un codice univoco da cui nascono vari prodotti con finiture e prezzo diversi
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticoloRepository")
 * @ORM\Table()
 */
class Articolo
{
    const NUM_ITEMS = 20;
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=13)
     */
    private $id;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
