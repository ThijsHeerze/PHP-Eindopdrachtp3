<?php
include_once('../Product.php');

class Cd extends Product{

    /*In deze implementatie heeft de CD-class een constructor die de Product-constructor aanroept en de extra eigenschappen (artist, numSongs, en label) vult. 
    Er zijn ook getters en setters voor elk van de extra eigenschappen.*/

    private $artiest;
    private $aantalSongs;
    private $label;

    public function __construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief, $artiest, $aantalSongs, $label){
        parent::__construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief);
        $this->artiest = $artiest;
        $this->aantalSongs = $aantalSongs;
        $this->label = $label;
    }

    public function setArtiest($artiest){
        $this->artiest = $artiest;
    }

    public function getArtiest(){
        return $this->artiest;
    }

    public function setAantalSongs($aantalSongs){
        $this->aantalSongs = $aantalSongs;
    }

    public function getAantalSongs(){
        return $this->aantalSongs;
    }

    public function setLabel($label){
        $this->label = $label;
    }

    public function getLabel(){
        return $this->label;
    }

    /*De getTotalValue()-functie berekent de totale waarde van de voorraad van een bepaalde CD door de prijs te vermenigvuldigen met het aantal in voorraad (numInStock).*/
    // public function getTotalValue() {
    //     return $this->getPrice() * $this->getNumInStock();
    // }

    /*De getAllProperties()-functie geeft een string terug met alle eigenschappen van de CD, inclusief de extra eigenschappen.*/
    // public function getAllProperties(){
    //     return 
    // }
    
    public function getAllProperties() {
        return "ID: " . $this->getId() . ", Name: " . $this->getName() . ", Price: " . $this->getPrice() .
            ", NumInStock: " . $this->getNumInStock() . ", Artist: " . $this->getArtist() .
            ", NumSongs: " . $this->getNumSongs() . ", Label: " . $this->getLabel();
    }

    public function toString()
    {
        return parent::toString() . "Artiest: " . $this->getArtiest() . "<br>"
            . "Aantal songs: " . $this->getAantalSongs() . "<br>"
            . "Label: " . $this->getLabel() . "<br>";
    }
}