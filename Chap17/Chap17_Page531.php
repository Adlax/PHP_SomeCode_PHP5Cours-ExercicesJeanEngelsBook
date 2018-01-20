<?php
include("connexpdo.inc.php");
$idcom=connexpdo("magasin","myparam");
$idcom->beginTransaction();
if($idcom->inTransaction())
{
    echo "Debut de transaction";
}
echo "<hr/>";
$requete1="INSERT INTO client VALUES(NULL,'Spencer','Marc','32','rue du blues','New Orleans','spencer@gmail.com')";
echo $requete1,"<hr/>";
$requete2="INSERT INTO client VALUES(NULL,'Spancer','Phil','43','rue de la soul','New Orleans','spancer@gmail>com')";
echo $requete2,"<hr/>";
$verif=$idcom->exec($requete1);
$verif+=$idcom->exec($requete2);
if($verif==2)
{
    $idcom->commit();
    echo "Transaction effectuee; $verif lignes inserees";
}
else
{
    $idcom->rollBack();
    $tab_erreures=$idcom->errorInfo();
    echo "Insertions annulees. Erreur numero $tab_erreures[0] <br/>";
    echo "iNFO ; $tab_erreures[2]";
}
?>
