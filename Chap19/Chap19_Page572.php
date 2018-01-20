<?php
$xml=simplexml_load_file("biblio3.xml");
$xml->livre[0]->titre="Ze Haine";
$xml->livre[0]->date="2008";
foreach($xml->livre as $cle=>$val)
{
  static $i=1;
  echo ucfirst($cle)." $i ; $val->titre de $val->auteur paru en $val->date <hr/>";
  $i++;
}
$chxml=$xml->asxml("biblio3.xml");
if($chxml)
{
  echo "Enregistrement bien fait";
}
?>
