<?php
$dest="h.videlier@gmail.com";
$objet="Votre commande";
$texte="Enculé!";
$headers='MIME-Version: 1.0' . "\r\n";
$headers.='From: Hadlax <info@address.com>' . "\r\n";
$headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($dest,$objet,$texte,$headers);
?>
