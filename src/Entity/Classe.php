<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $descrizione;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articolo", mappedBy="classe")
     */
    private $articoli;

    public function __construct()
    {
        $this->articoli = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodice(): ?string
    {
        return $this->codice;
    }

    public function setCodice(string $codice): self
    {
        $this->codice = $codice;

        return $this;
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
            $articoli->setClasse($this);
        }

        return $this;
    }

    public function removeArticoli(Articolo $articoli): self
    {
        if ($this->articoli->contains($articoli)) {
            $this->articoli->removeElement($articoli);
            // set the owning side to null (unless already changed)
            if ($articoli->getClasse() === $this) {
                $articoli->setClasse(null);
            }
        }

        return $this;
    }
}
