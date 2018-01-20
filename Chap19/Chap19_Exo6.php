<?php
$xml=simplexml_load_file("iut2.xml");
include_once("connex.inc.php");
$idcom=connex("iut","myparam");
for($i=0;$i<2;$i++)
{
  echo "Insertion etudiant numero $i";
  $id=$xml->etudiant[$i]['id'];
  $nom=$xml->etudiant[$i]['nom'];
  $uv1=$xml->etudiant[$i]->uv[0]->nom;
  $duree1=$xml->etudiant[$i]->uv[0]->duree;
  $note1=$xml->etudiant[$i]->uv[0]->note;
  $uv2=$xml->etudiant[$i]->uv[1]->nom;
  $duree2=$xml->etudiant[$i]->uv[1]->duree;
  $note2=$xml->etudiant[$i]->uv[1]->note;
  $requete="INSERT INTO 'etudiant' VALUES('$id','$nom','$uv1','$duree1','$note1','$uv2','$duree2','$note2')";
  $verif=mysql_query($requete,$idcom);
  if($verif)
  {
    echo "Tout ok!";
  }
}
?>
