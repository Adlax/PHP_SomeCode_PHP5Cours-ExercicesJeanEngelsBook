<?php
$xml=simplexml_load_file("biblio1.xml");
echo "Titre ; ".$xml->titre."<br/>";
echo "Auteur; ".$xml->auteur."<br/>";
echo "Date ; ".$xml->date."<br/>";
?>
