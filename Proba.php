<?php

require_once 'Korrikalari.php';
require_once 'Txapelketa.php';

echo "<h1>Txapelketa - Froga Fitxategia</h1>";

$txapelketa = new Txapelketa();


$izenakAdibideak = ["Jon", "Ane", "Miren", "Aitor", "Gorka", "Leire", "Maite", "Koldo"];

echo "<h2>1. Korrikalariak eta lasterketak ausaz sortzen...</h2>";


for ($i = 1; $i <= 5; $i++) {
    $izena = $izenakAdibideak[array_rand($izenakAdibideak)];
    $kodea = "KORR" . rand(100, 999);

    $korrikalari = new Korrikalari($izena, $kodea);
    $txapelketa->korrikalariagehitu($korrikalari);

    $lasterketaKopuru = rand(2, 4);
    for ($j = 0; $j < $lasterketaKopuru; $j++) {
        $denbora = rand(6, 25); 
        $txapelketa->gehitulasterketakorrikalariari($kodea, $denbora);
    }
}

echo "<p> Korrikalariak eta lasterketak ondo kargatu dira.</p>";

echo "<h2>2. Kalkuluen Emaitzak</h2>";


$bb1 = $txapelketa->batezbestekoa1();
echo "<p><strong>1. lasterketako batez besteko denbora:</strong> " . round($bb1, 2) . " segundo</p>";


$bizkorrena = $txapelketa->bizkorrena();
if ($bizkorrena) {
    echo "<p><strong>Korrikalari bizkorrena:</strong> " . $bizkorrena->getIzena() . " (" . $bizkorrena->getKodea() . ")</p>";
} else {
    echo "<p><strong>Korrikalari bizkorrena:</strong> Ez da aurkitu.</p>";
}


$lasterketa2Gehiago15 = $txapelketa->lasterketa2();
echo "<p><strong>2. lasterketan 15s baino gehiago eman dituztenak:</strong> ";
echo !empty($lasterketa2Gehiago15) ? implode(", ", $lasterketa2Gehiago15) : "Inor ez";
echo "</p>";

$izenakE = $txapelketa->e();
echo "<p><strong>'e' letraz amaitzen diren izenak:</strong> ";
echo !empty($izenakE) ? implode(", ", $izenakE) : "Bat ere ez";
echo "</p>";


echo "<h2>3. Salbuespenen (Exceptions) Probak</h2>";


try {
    echo "<p> Probatzen: 3 segundoko lasterketa bat gehitu...</p>";
    $kProba = new Korrikalari("Proba", "TEST1");
    $kProba->lasterketaGehitu(3);
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>Harrapatutako errorea:</strong> " . $e->getMessage() . "</p>";
}

try {
    echo "<p>Probatzen: Korrikalari bati 6 lasterketa gehitu...</p>";
    $kProba2 = new Korrikalari("Muga", "TEST2");
    for ($i = 1; $i <= 6; $i++) {
        $kProba2->lasterketaGehitu(10);
    }
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>Harrapatutako errorea:</strong> " . $e->getMessage() . "</p>";
}
?>