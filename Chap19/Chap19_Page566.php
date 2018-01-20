<?php
$xml=simplexml_load_file('biblio2.xml');
foreach($xml->livre as $cle=>$val)
{
  static $i=1;
  echo ucfirst($cle).$i." ; $val->titre de $val->auteur parue en $val->date <hr/>";
  $i++;
}
?>
