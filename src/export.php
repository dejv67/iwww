<?php

$mysqli = new mysqli('db', 'user', 'password', 'db_dev');
$result = $mysqli->query("SELECT * FROM rez_vyuky ORDER BY dat_od ASC ");


$xml = new XMLWriter();

$xml->openURI('php://output');
$xml->startDocument('1.0');
$xml->setIndent(true);

$xml->startElement('seznamRezervaci');

while ($row = mysqli_fetch_assoc($result)) {
    $xml->startElement("rezervace");
    $xml->writeElement("idRezervace", $row['id_rez']);
    $xml->writeElement("datumOD", $row['dat_od']);
    $xml->writeElement("datumDO", $row['dat_do']);
    $xml->writeElement("pocetHodin", $row['poc_hod']);
    $xml->writeElement("email", $row['email_zak']);
    $xml->writeElement("pocetDeti", $row['poce_deti']);
    $xml->writeElement("stavPotvrzeni", $row['stav']);
    $xml->writeElement("pujceno", $row['zap_vybava']);
    $xml->writeElement("jmenaDeti", $row['jmena_deti']);
    $xml->writeElement("poznamka", $row['pozn']);
    $xml->writeElement("idZakaznika", $row['rez_zak_id']);
    $xml->writeElement("idNabidky", $row['rez_nab_id']);
    $xml->writeElement("nastroj", $row['nastroj']);
    $xml->writeElement("jmenoZakaznika", $row['jmenoZak']);


    $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
$xml->flush();


?>