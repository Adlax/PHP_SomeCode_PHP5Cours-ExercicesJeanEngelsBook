<?php
include_once("en_tete.php");

$mot_cle=$_POST['mot_cle'];
$choix_auteur=$_POST['choix_auteur'];
$choix_siecle=$_POST['choix_siecle'];
$tri=$_POST['tri'];
$requete="SELECT nom,prenom,texte,siecle FROM dico.auteurs AS A,dico.citations AS C WHERE";
if(isset($mot_cle))
{
  $requete.=" texte LIKE '%$mot_cle%'";
}
else
{
  $requete.=" 1";
}
if(isset($choix_auteur))
{
  $requete.=" AND auteur='$choix_auteur'";
}
else
{
  $requete.="";
}
if(isset($choix_siecle))
{
  $requete.=" AND siecle='$choix_siecle'";
}
else
{
  $requete.="";
}
$requete.=" AND A.idauteur=C.idauteur";
$requete.=" ORDER BY $tri ASC";

include_once('connex.inc.php');
$idcom=connex("dico","myparam");
echo $requete;
$result=mysql_query($requete,$idcom) or die("ERREUR RESULTAT");
if(!$result)
{
  echo "<h2>Pas de résultats</h2>";
}
else
{
  echo "<h2>Citations avec $mot_cle</h2> <hr/>";
  while($tab=mysql_fetch_assoc($result))
  {
    echo "<h4>".nl2br($tab['texte'])."</h4> <br/>";
    echo "<h4> <cite>".$tab['prenom']." ".$tab['nom']."(".$tab['siecle']."<sup>ieme</sup> siecle)"."</cite> </h4> <hr/>";
  }

}

include_once("pied.php");
?>
