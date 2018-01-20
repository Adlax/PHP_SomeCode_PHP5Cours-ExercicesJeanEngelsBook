<?php
include('connexobject.inc.php');
$idcom=connexobject("magasin","myparam");
$idcom->autocommit(FALSE);
$requete1="INSERT INTO articles VALUES('AZZERT','Lecteur MP3','59,50','divers')";
$requete2="INSERT INTO article VALUES('QSDFG','Bridge Samsung de ta mere 10 Mo','358','photo')";
$idcom->query($requete1);
$nb=$idcom->affected_rows;
echo "Pour le moment nous avons afféctés $nb lignes dans article <hr/>";
$idcom->query($requete2);
$nb+=$idcom->affected_rows;
echo "Pour le moment nous avons afféctés $nb lignes dans article <hr/>";

if($nb==2)
{
  $idcom->commit();
  echo $nb."lignes ont été afféctées";
}
else
{
  $idcom->rollback();
  echo "transaction annulée, donc rollback";
}
?>
