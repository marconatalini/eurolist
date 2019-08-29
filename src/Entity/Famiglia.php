<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamigliaRepository")
 */
class Famiglia
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=30)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descrizione;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Articolo", inversedBy="famiglie")
     */
    private $articoli;

    public function __toString()
    {
        return $this->getId();
    }


    public function __construct()
    {
        $this->articoli = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(?string $descrizione): self
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * @return Collection|Articolo[]
     */
    public function getArticoli(): Collection
    {
        return $this->articoli;
    }

    public function addArticoli(Articolo $articoli): self
    {
        if (!$this->articoli->contains($articoli)) {
            $this->articoli[] = $articoli;
        }

        return $this;
    }

    public function removeArticoli(Articolo $articoli): self
    {
        if ($this->articoli->contains($articoli)) {
            $this->articoli->removeElement($articoli);
        }

        return $this;
    }
}
