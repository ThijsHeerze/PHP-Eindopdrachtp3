<?php

class Product {
    private static $itemnr_counter = 0; // Een static variabele die bijhoudt hoeveel producten er zijn aangemaakt
    private $itemnr;
    private $naam;
    private $aantalInVoorraad;
    private $minimumVoorraad;
    private $prijs;
    private $actief;

    // Constructor:
    public function __construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief) {
        self::$itemnr_counter++;
        $this->itemnr = self::$itemnr_counter;
        $this->naam = $naam;
        $this->aantalInVoorraad = $aantalInVoorraad;
        $this->minimumVoorraad = $minimumVoorraad;
        $this->prijs = $prijs;
        $this->actief = $actief;
    }
    
    //Getters en setters:
    public function getItemnr() {
        return $this->itemnr;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function getAantalInVoorraad() {
        return $this->aantalInVoorraad;
    }

    public function setAantalInVoorraad($aantal) {
        if ($this->actief) {    // Als het product actief is, mag het aantal in voorraad niet negatief worden
            $this->aantalInVoorraad += $aantal;
        }
    }

    public function getMinimumVoorraad() {  
        return $this->minimumVoorraad;
    }

    public function setMinimumVoorraad($minimum) {
        $this->minimumVoorraad = $minimum;
    }

    public function getPrijs() {
        return $this->prijs;
    }

    public function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    public function isActief() {
        return $this->actief;
    }

    public function setActief($actief) {
        $this->actief = $actief;
    }

    //toString functie returnt alles als strings.
    public function toString() {
        //als de boolean $this->actief waar is, wordt "Ja" gereturned, anders "Nee"
        return "Itemnr: " . $this->itemnr . 
        ", Naam: " . $this->naam . 
        ", Aantal in voorraad: " . $this->aantalInVoorraad . 
        ", Minimum voorraad: " . $this->minimumVoorraad . 
        ", Prijs: " . $this->prijs . 
        ", Actief: " . ($this->actief ? "Ja" : "Nee");
    }

    //Deze functie verhoogd de voorraad.
    public function verhoogVoorraad($aantal) {
        if ($this->actief) {
            $this->aantalInVoorraad += $aantal;
        }
    }
    //Deze functie zorgt ervoor dat de voorraad wordt verlaagd.
    public function verlaagVoorraad($aantal) {
        if ($this->aantalInVoorraad - $aantal >= $this->minimumVoorraad) { // Als het aantal in voorraad na het verlagen van de voorraad groter of gelijk is aan het minimum aantal in voorraad, mag het aantal in voorraad verlaagd worden
            $this->aantalInVoorraad -= $aantal;
        }
    }
    //functie getTotaleWaarde returnt de prijs x aantalInVoorraad
    public function getTotaleWaarde() {
        return $this->prijs * $this->aantalInVoorraad;
    }
}

//Met deze functie worden de klassen geladen
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Functie om data uit een CSV-bestand te lezen en om te zetten in een array
function readCSV($file) {
    $rows = array();
    if (($handle = fopen($file, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
           error_reporting(0);
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

//Array met data uit csv bestand voor de cds en dvds
$cdData = readCSV('bestand.csv');
$dvdData = readCSV('bestand.csv');

//Array voor de cds
$cds = array();
foreach ($cdData as $data) {
    $cd = new CD($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
    $cds[] = $cd;
}

//Array voor de dvds
$dvds = array();
foreach ($dvdData as $data) {
    $dvd = new DVD($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
    $dvds[] = $dvd;
}

//Functie sortObjectsByProperty zorgt dat je een array per object kunt sorteren
function sortObjectsByProperty($objects, $property) {
    usort($objects, function($a, $b) use ($property) {
        return $a->$property > $b->$property;
    });
    return $objects;
}

//Sorteren van cds en dvds op naam en weergeven in browser
$cds = sortObjectsByProperty($cds, 'naam');
$dvds = sortObjectsByProperty($dvds, 'naam');

echo "<h2>CD's</h2>"; 
foreach ($cds as $cd) {
    echo $cd->toString() . '<br>';
}
echo "<br><h2>DVD's</h2>";
foreach ($dvds as $dvd) {
    echo $dvd->toString() . '<br>';
}
