<?php
$xml=simplexml_load_file("biblio3.xml");
foreach($xml->livre as $val)
{
  echo "<h3>$val->titre de $val->auteur</h3> <b>Parue en $val->date</b> ";
  foreach($val->attributes() as $att=>$valatt)
  {
    echo "<b> $att : $valatt </b>";
  }
  echo "<hr/>";
}
?>
