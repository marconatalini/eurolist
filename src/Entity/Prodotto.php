<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdottoRepository")
 * @ORM\Table()
 */
class Prodotto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", scale=3, precision=9)
     */
    private $prezzo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Listino", inversedBy="prodotti")
     * @ORM\JoinColumn()
     */
    private $listino;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Finitura", inversedBy="prodotti")
     * @ORM\JoinColumn()
     */
    private $finitura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articolo", inversedBy="prodotti")
     * @ORM\JoinColumn()
     */
    private $articolo;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrezzo()
    {
        return $this->prezzo;
    }

    /**
     * @param mixed $prezzo
     */
    public function setPrezzo($prezzo): void
    {
        $this->prezzo = $prezzo;
    }

    /**
     * @return mixed
     */
    public function getListino()
    {
        return $this->listino;
    }

    /**
     * @param mixed $listino
     */
    public function setListino($listino): void
    {
        $this->listino = $listino;
    }

    /**
     * @return mixed
     */
    public function getFinitura()
    {
        return $this->finitura;
    }

    /**
     * @param mixed $finitura
     */
    public function setFinitura($finitura): void
    {
        $this->finitura = $finitura;
    }

    /**
     * @return mixed
     */
    public function getArticolo()
    {
        return $this->articolo;
    }

    /**
     * @param mixed $articolo
     */
    public function setArticolo($articolo): void
    {
        $this->articolo = $articolo;
    }

}
