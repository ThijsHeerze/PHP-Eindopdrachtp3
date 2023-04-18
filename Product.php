<?php

class Product {
    protected static $itemnr = 1;
    protected $naam;
    protected $aantalInVoorraad;
    protected $minimumVoorraad;
    protected $prijs;
    protected $actief;

    public function __construct($naam, $aantalInVoorraad, $minimumVoorraad, $prijs, $actief){
        self::$itemnr++;
        $this->naam = $naam;
        $this->aantalInVoorraad = $aantalInVoorraad;
        $this->minimumVoorraad = $minimumVoorraad;
        $this->prijs = $prijs;
        $this->actief = $actief;
    }

    public static function getItemnr(){
        return self::$itemnr;
    }

    public function getNaam(){
        return $this->naam;
    }

    public function setNaam($naam){
        $this->naam = $naam;
    }

    public function getAantalInVoorraad(){
        return $this->aantalInVoorraad;
    }

    public function setAantalInVoorraad($aantal){
        if ($this->actief){
            $this->aantalInVoorraad += $aantal;
        }
    }

    public function getMinimumVoorraad(){
        return $this->minimumVoorraad;
    }

    public function setMinimumVoorraad($minimum){
        $this->minimumVoorraad = $minimum;
    }

    public function getPrijs(){
        return $this->prijs;
    }

    public function setPrijs($prijs){
        $this->prijs = $prijs;
    }

    public function isActief(){
        return $this->actief;
    }

    public function setActief($actief){
        $this->actief = $actief;
    }

    public function __toString(){
        return $this->naam 
        .'<br/>'. $this->aantalInVoorraad 
        .'<br/>'. $this->minimumVoorraad 
        .'<br/>'. $this->prijs 
        .'<br/>'. $this->actief;
    }

    public function ophogenVoorraad($aantal) {
        if ($this->actief) {
            $this->aantalInVoorraad += $aantal;
        }
    }

    public function verlagenVoorraad($aantal) {
        if ($this->aantalInVoorraad - $aantal >= $this->minimumVoorraad) {
            $this->aantalInVoorraad -= $aantal;
        }
    }

    public function totaleWaarde() {
        return $this->prijs * $this->aantalInVoorraad;
    }
}

$test = new Product('thijs', '20', '5', '4 euro', 'ja');

echo $test;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$csv = array();
$file = fopen('dvd.csv', 'r');
$file = fopen('cd.csv', 'r');

if (!$file) {
    die("Unable to open file.");
}

while (($line = fgetcsv($file)) !== FALSE) {
    $dvd = new DVD($line[0], (int)$line[1], (int)$line[2], (float)$line[3], (bool)$line[4], $line[5], (int)$line[6], $line[7]);
    $cd = new CD($line[0], (int)$line[1], (int)$line[2], (float)$line[3], (bool)$line[4], $line[5], (int)$line[6], $line[7]);
    $csv[] = $dvd;
    $csv[] = $cd;
}

fclose($file);

foreach ($csv as $dvd) {
    echo $dvd->toString() . "<br>";
}

foreach ($csv as $dvd) {
    $product = new DVD($dvd->getTitle(), $dvd->getLength(), $dvd->getPrice(), $dvd->getTax(), $dvd->isDiscounted(), $dvd->getDirector(), $dvd->getAgeRating(), $dvd->getSubtitle());
    echo $product->toString() . "<br>";
}

foreach ($csv as $cd) {
    $product = new CD($cd[0], (int)$cd[1], (int)$cd[2], (float)$cd[3], (bool)$cd[4], $cd[5], (int)$cd[6], $cd[7]);
    echo $product->toString() . "<br>";
}