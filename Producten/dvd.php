<?php
include_once('../Product.php');

class Dvd extends Product{

    /*De class heeft de extra eigenschappen lengteInMinuten, jaarUitgifte en filmStudio, en de extra functies getTotalValue(), formatLengteInMinuten() en toString(). 
    De constructor zorgt ervoor dat de eigenschappen worden gevuld en de parent constructor wordt aangeroepen met de eerste vier parameters. De getters en setters spreken voor zichzelf. */
    
    private $lengteInMinuten;
    private $jaarUitgifte;
    private $filmStudio;
    private $productCode;

    public function __construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief, $lengteInMinuten, $jaarUitgifte, $filmStudio){
        parent::__construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief);
        $this->lengteInMinuten = $lengteInMinuten;
        $this->jaarUitgifte = $jaarUitgifte;
        $this->filmStudio = $filmStudio;
        $this->productCode = $productCode;
    }

    public function setLengteInMinuten($lengteInMinuten){
        $this->lengteInMinuten = $lengteInMinuten;
    }

    public function getLengteInMinuten(){
        return $this->lengteInMinuten;
    }

    public function setJaarUitgifte($jaarUitgifte){
        $this->jaarUitgifte = $jaarUitgifte;
    }

    public function getJaarUitgifte(){
        return $this->jaarUitgifte;
    }

    public function setFilmStudio($filmStudio){
        $this->filmStudio = $filmStudio;
    }

    public function getFilmStudio(){
        return $this->filmStudio;
    }

    public function getProductCode() {
        return $this->productCode;
    }
    public function setProductCode($productCode){
        $this->productCode = $productCode;
    }

    /*De getTotalValue() functie berekent de totale waarde van de voorraad van de DVD, 
    rekening houdend met een factor van 1.05.*/
    // public function getTotalValue(){
    //     return $this->getPrice() * $this->getNumInStock() * 1.05;
    // }
    
    //Deze functie berekent de uren en minuten
    public function lengteInMinuten() {
        $uren = floor($this->lengteInMinuten / 60);
        $minuten = $this->lengteInMinuten % 60;
        return sprintf("%02d:%02d", $uren, $minuten);
    }

    public function toString()
    {
        return parent::toString() . "Lengte in minuten: " . $this->getArtiest() . "<br>"
            . "Jaaruitgifte: " . $this->getAantalSongs() . "<br>"
            . "Filmstudio: " . $this->getLabel() . "<br>";
    }
}