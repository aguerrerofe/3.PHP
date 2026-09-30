<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once 'Korrikalari.php';

class Txapelketa {
    private $array_asoziatibo;

    public function __construct() {
        $this->array_asoziatibo = array();
    }

    public function korrikalariagehitu($korrikalari) {
        $kod = $korrikalari->getKodea();
        $this->array_asoziatibo[$kod] = $korrikalari;
    }

    public function gehitulasterketakorrikalariari($kode, $denbora) {
        if (isset($this->array_asoziatibo[$kode])) {
            $this->array_asoziatibo[$kode]->lasterketaGehitu($denbora);
        } else {
            throw new Exception("Ez da aurkitu '$kode' kodea duen korrikalaririk.");
        }
    }

    public function batezbestekoa1() {
        $batez = 0;
        $kont = 0;
        foreach ($this->array_asoziatibo as $korrikalari) {
            $array = $korrikalari->getSegarray();
            if (isset($array[0])) {
                $batez += $array[0];
                $kont++;
            }
        }
        return $kont > 0 ? $batez / $kont : 0;
    }

    public function batezbestekoa($korri) {
        $array = $korri->getSegarray();
        if (count($array) === 0) {
            return 0;
        }
        return array_sum($array) / count($array);
    }

    public function bizkorrena() {
        $bizkorrena = 9999;
        $korrikalaria = null;

        foreach ($this->array_asoziatibo as $korrikalari) {
            $lehen = $this->batezbestekoa($korrikalari); 
            if ($lehen > 0 && $lehen <= $bizkorrena) {
                $bizkorrena = $lehen;
                $korrikalaria = $korrikalari;
            }
        }
        return $korrikalaria;
    }

    public function lasterketa2() {
        $izenak = [];
        foreach ($this->array_asoziatibo as $korrikalari) {
            $array = $korrikalari->getSegarray();
            if (isset($array[1]) && $array[1] > 15) {
                $izenak[] = $korrikalari->getIzena();
            }
        }  
        return $izenak;
    }

    public function e() {
        $emai = [];
        foreach ($this->array_asoziatibo as $korrikalari) {
            $izena = $korrikalari->getIzena();
            if (strtolower(substr($izena, -1)) === "e") {
                $emai[] = $izena;
            }
        }
        return $emai;
    }
}
?>
</body>
</html>