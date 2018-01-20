<?php
include_once("en_tete.php");

$mot_cle=$_POST['mot_cle'];
$choix_auteur=$_POST['choix_auteur'];
$choix_siecle=$_POST['choix_siecle'];
$tri=$_POST['tri'];
$requete="SELECT nom,prenom,texte,siecle FROM citations,auteurs WHERE citations.idauteur=auteurs.idauteur AND ";
if(isset($mot_cle))
{
  $requete.="texte LIKE '%$mot_cle%'";
}
else
{
  $requete.="";
}
if($choix_auteur!="tous")
{
  $requete.=" AND nom='$choix_auteur'";
}
else
{
  $requete.="";
}
if($choix_siecle!="0")
{
  $requete.=" AND siecle='$choix_siecle'";
}
else
{
  $requete.="";
}
$requete.=" ORDER BY $tri ASC";

include_once('connex.inc.php');
$idcom=connex("dico","myparam");
echo $requete."<br/>";
$result=mysql_query($requete,$idcom) or die("ERREUR RESULTAT");
if(!$result)
{
  echo "<h2>Pas de résultats</h2>";
}
else
{
  echo "<h2>Citations recherchée</h2> <hr/>";
  while($tab=mysql_fetch_object($result))
  {
    echo "<h4>".$tab->texte."</h4> <br/>";
    echo $tab->prenom." ".$tab->nom." ".$tab->siecle."ieme siecle"."<hr/>";
  }
  echo "FIN";
}

include_once("pied.php");
?>
