<?php // Goto4ever.com
function GT4Elog($log, $file = "logs.log") //créé un fichier logs dans le dossier root et y ajoute le contenu en parramètre.
{
    $fileopen=(fopen("$file",'a'));
    fwrite($fileopen, $today = date("Y-m-d H:i:s")." -> ".$log."\r\n"); // date-heure + log
    fclose($fileopen);
}

function GT4Esitemap()
{

}
?>
