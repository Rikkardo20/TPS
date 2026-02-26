<?php
function CalcolaConversione($valoreQuantita, $unitaOrigine, $unitaDestinazione){

$percorsoXML="unita.xml";

$datiXML = simplexml_load_file($percorsoXML);

$listaFattori = [];

foreach($datiXML->unita as $elementoUnita) {

    if ($unitaOrigine==$elementoUnita['codice'] || $unitaDestinazione==$elementoUnita['codice']) {
        $listaFattori[(string)$elementoUnita['codice']] = (float)$elementoUnita['fattore'] ;
    }

}
    if(isset($listaFattori[$unitaOrigine]) || isset($listaFattori[$unitaDestinazione])){
        $valoreConvertito = round(($valoreQuantita / $listaFattori[$unitaOrigine] * $listaFattori[$unitaDestinazione]),3);
    }
    return $valoreConvertito; 

}

$istanzaServer= new SoapServer("funzione.wsdl");

$istanzaServer->addFunction("CalcolaConversione");

$istanzaServer->handle();

?>

