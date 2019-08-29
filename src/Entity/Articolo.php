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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Articolo", inversedBy="linkedBy")
     */
    private $linkedTo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Articolo", mappedBy="linkedTo")
     */
    private $linkedBy;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Famiglia", mappedBy="articoli")
     */
    private $famiglie;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $immagine;


    public function __construct()
    {
        $this->prodotti = new ArrayCollection();
        $this->linkedTo = new ArrayCollection();
        $this->linkedBy = new ArrayCollection();
        $this->famiglie = new ArrayCollection();
    }

    public function __toString() : string
    {
        return $this->getId();
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

    /**
     * @return Collection|self[]
     */
    public function getLinkedTo(): Collection
    {
        return $this->linkedTo;
    }

    public function addLinkedTo(self $linkedTo): self
    {
        if (!$this->linkedTo->contains($linkedTo)) {
            $this->linkedTo[] = $linkedTo;
        }

        return $this;
    }

    public function removeLinkedTo(self $linkedTo): self
    {
        if ($this->linkedTo->contains($linkedTo)) {
            $this->linkedTo->removeElement($linkedTo);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getLinkedBy(): Collection
    {
        return $this->linkedBy;
    }

    public function addLinkedBy(self $linkedBy): self
    {
        if (!$this->linkedBy->contains($linkedBy)) {
            $this->linkedBy[] = $linkedBy;
            $linkedBy->addLinkedTo($this);
        }

        return $this;
    }

    public function removeLinkedBy(self $linkedBy): self
    {
        if ($this->linkedBy->contains($linkedBy)) {
            $this->linkedBy->removeElement($linkedBy);
            $linkedBy->removeLinkedTo($this);
        }

        return $this;
    }

    /**
     * @return Collection|Famiglia[]
     */
    public function getFamiglie(): Collection
    {
        return $this->famiglie;
    }

    public function addFamiglie(Famiglia $famiglie): self
    {
        if (!$this->famiglie->contains($famiglie)) {
            $this->famiglie[] = $famiglie;
            $famiglie->addArticoli($this);
        }

        return $this;
    }

    public function removeFamiglie(Famiglia $famiglie): self
    {
        if ($this->famiglie->contains($famiglie)) {
            $this->famiglie->removeElement($famiglie);
            $famiglie->removeArticoli($this);
        }

        return $this;
    }

    public function getImmagine(): ?string
    {
        return $this->immagine;
    }

    public function setImmagine(?string $immagine): self
    {
        $this->immagine = $immagine;

        return $this;
    }


}
