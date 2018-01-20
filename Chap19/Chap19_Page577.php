<?php
if(isset($_POST['REC']))
{
  $titre=$_POST['titre'];
  $auteur=$_POST['auteur'];
  $date=$_POST['date'];
  if(!file_exists("biblio6.xml"))
  {
    $chxml="<?xml version=\"1.0\" encoding=\"UTF-8\" ?> \n <biblio> \n <livre> \n <titre>$titre</titre> \n <auteur>$auteur</auteur> \n <date>$date</date> \n </livre> \n </biblio>";
  }
  else
  {
    $xml=simplexml_load_file("biblio6.xml");
    $chxml=$xml->asXML();
    $chxml.=str_replace("</biblio>","",$chxml);
    $chxml.="<livre> \n <titre>$titre</titre> \n <auteur>$auteur</auteur> \n <date>$date</date> \n </livre> \n </biblio>";
  }
  $verif=file_put_contents("biblio6.xml",$chxml);
  if($verif)
  {
    echo "Livre bien enregistré";
  }
}
?>
