<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
class Korrikalari {
    private $izena;
    private $kodea;
    private $segarray;

    public function __construct($izena, $kodea) {
        $this->izena = $izena;
        $this->kodea = $kodea;
        $this->segarray = array();
    }

    public function getIzena() {
        return $this->izena;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function getKodea() {
        return $this->kodea;
    }

    public function setKodea($kodea) {
        $this->kodea = $kodea;
    }

    public function getSegarray() {
        return $this->segarray;
    }

    public function setSegarray($segarray) {
        $this->segarray = $segarray;
    }

    public function lasterketaGehitu($segunduak) {
        if ($segunduak < 5) {
            throw new Exception("Errorea: Lasterketa ezin da 5 segundo baino gutxiagokoa izan.");
        }
        
        if (count($this->segarray) >= 5) {
            throw new Exception("Errorea: Korrikalariak dagoeneko 5 lasterketa ditu.");
        }

        $this->segarray[] = $segunduak;
    }
}
?>
</body>
</html>