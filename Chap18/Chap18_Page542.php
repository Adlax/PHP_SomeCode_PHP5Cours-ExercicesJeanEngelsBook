<?php
$objdb=new SQLite3('Sportifeuzes.db');
$requete="SELECT * FROM personne";
if($result=$objdb->query($requete))
{
  echo "La requete est réalisée";
  var_dump($result);
}
else
{
  echo "Erreur n° ; ",$objdb->lastErrorCode(),"...",$objdb->lastErrorMsg();
}
$objdb->close();
?>
