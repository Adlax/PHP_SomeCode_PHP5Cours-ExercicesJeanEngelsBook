<?php
if($objdb=new SQLite3('Sportifeuzes.db'))
{
  $requete1="BEGIN TRANSACTION transac";
  $objdb->exec($requete1);
  $requete2="INSERT INTO personne(id_personne,nom,prenom,depart,mail) VALUES(NULL,'Spencer','Marc','75','marcspencer@hkm.zob')";
  $test1=$objdb->exec($requete2);
  $requete3="INSERT INTO pratique(id_personne,id_sport,niveau) VALUES('last_insert_rowid()','2','3')";
  $test2=$objdb->exec($requete3);
  if($test1 && $test2)
  {
    $requete4="COMMIT TRANSACTION transac";
    $objdb->exec($requete4);
    echo "<br/> Les requetes ont bien été éfféctuées<hr/>";
  }
  else
  {
    $requete5="ROLLBACK TRANSACTION transac";
    $objdb->exec($requete5);
    echo "<br/> Les requetes ont échouées<hr/>";
  }
  $objdb->close();
}
else
{
  echo "Erreur";
}
?>
