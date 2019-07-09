<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListinoRepository")
 * @ORM\Table()
 */
class Listino
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dataEmissione;

    /**
     * @ORM\Column(type="date", nullable=True)
     */
    private $dataScadenza;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prodotto", mappedBy="listino")
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
    public function getDataEmissione()
    {
        return $this->dataEmissione;
    }

    /**
     * @param mixed $dataEmissione
     */
    public function setDataEmissione($dataEmissione): void
    {
        $this->dataEmissione = $dataEmissione;
    }

    /**
     * @return mixed
     */
    public function getDataScadenza()
    {
        return $this->dataScadenza;
    }

    /**
     * @param mixed $dataScadenza
     */
    public function setDataScadenza($dataScadenza): void
    {
        $this->dataScadenza = $dataScadenza;
    }

    /**
     * @return mixed
     */
    public function getProdotti()
    {
        return $this->prodotti;
    }
}
