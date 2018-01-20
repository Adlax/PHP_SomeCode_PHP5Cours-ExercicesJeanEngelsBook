<?php
$xml=simplexml_load_file("biblio3.xml");
include_once("connex.inc.php");
$idcom=connex("biblio","myparam");
$nblivre=count($xml->livre);
echo "Le nombre de livres est ;".$nblivre."<hr />";
for($i=0;$i<$nblivre;$i++)
{
  echo "NB ; $i";
  $editeur=$xml->livre[$i][@editeur];
  $prix=$xml->livre[$i][@prix];
  $titre=$xml->livre[$i]->titre;
  $auteur=$xml->livre[$i]->auteur;
  $date=$xml->livre[$i]->date;
  $requete="INSERT INTO livre VALUES('\N','$editeur','$prix','$titre','$auteur','$date')";
  $verif=mysql_query($requete,$idcom);
  if($verif)
  {
    echo "Bien inséré dans la base et table livre <hr />";
  }
}
?>
