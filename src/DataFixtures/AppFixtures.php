<?php

namespace App\DataFixtures;

use App\Entity\Articolo;
use App\Entity\Finitura;
use App\Entity\Listino;
use App\Entity\Prodotto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    //php bin/console doctrine:fixtures:load --purge-with-truncate

    /**@var ArrayCollection $codiciArticolo */
    private $codiciArticolo;

    /**@var ArrayCollection $finiture */
    private $finiture;

    public function __construct()
    {
        $this->codiciArticolo = new ArrayCollection();
        $this->finiture= new ArrayCollection();
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->loadListini($manager);
        $this->loadFiniture($manager);
        $this->loadArticoli($manager);
        $this->loadProdotti($manager);
    }

    private function loadArticoli(ObjectManager $manager)
    {
        $prefix = ['AZ','X0','Y0','AS'];
        $larg = [41,52,60,70,81,90,53,66,75,85];
        $spess = [145,165,100,200];
        $tipo = ['anta', 'telaio', 'zoccolo', 'piantone'];

        for ($i = 0; $i <50; $i++ ) {
            $articolo = new Articolo();
            $tmp_larg = $larg[array_rand($larg)];

            $codice = $prefix[array_rand($prefix)] . $tmp_larg . $spess[array_rand($spess)];
            $descr = "Profilo " . $tipo[array_rand($tipo)] . " da " . $tmp_larg . " mm";
            $articolo->setCodice($codice);
            $articolo->setDescrizione($descr);
            if (!$this->codiciArticolo->contains($codice)) {
                $this->addReference($codice, $articolo);
                $this->codiciArticolo->add($codice);
                $manager->persist($articolo);
            } else {
                $i--;
            }
        }
        $manager->flush();
    }

    private function loadFiniture(ObjectManager $manager)
    {
        $descrizione = ['GREZZO', 'RAL', 'PULVER', 'METALLIZZATO', 'DECOR LEGNO', 'OSSIDATO', 'GOLD',];

        foreach ($descrizione as $f){
            $finitura = new Finitura();
            $finitura->setDescrizione($f);
            $this->addReference($f, $finitura);
            $this->finiture->add($f);
            $manager->persist($finitura);
        }
        $manager->flush();
    }

    private function loadListini(ObjectManager $manager)
    {
        $listino = new Listino();
        $listino->setDataEmissione(new \DateTime());
        $this->addReference('listino2019', $listino);
        $manager->persist($listino);

        $manager->flush();
    }

    private function loadProdotti(ObjectManager $manager)
    {
        foreach ($this->codiciArticolo as $codice){
            foreach ($this->finiture as $finitura){
                $prodotto = new Prodotto();
                $prodotto->setListino($this->getReference('listino2019'));
                $prodotto->setFinitura($this->getReference($finitura));
                $prodotto->setArticolo($this->getReference($codice));
                $prodotto->setPrezzo(rand(351, 1599 )/100);
                $manager->persist($prodotto);
            }
        }

        $manager->flush();
    }
}
