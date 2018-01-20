<?php
function presentation($mot)
{
  return ucfirst(strtolower($mot));
}

if($objdb=new SQLite3('Sportifeuzes.db',SQLITE3_OPEN_READONLY))
{
  $objdb->createFunction('initiale','presentation');
  $requete="SELECT initiale(nom) AS nom,initiale(prenom) AS prenom,lower(mail) AS mail FROM personne";
  if($result=$objdb->query($requete))
  {
    echo "<h3>La liste des personnes</h3>";
    while($ligne=$result->fetchArray(SQLITE3_BOTH))
    {
      //echo $ligne[0]."&nbsp;".$ligne[1]."&nbsp;".$ligne[2]."<br/>";
      echo $ligne['nom']."&nbsp;&nbsp;&nbsp;".$ligne['prenom']."&nbsp;&nbsp;&nbsp;".$ligne['mail']."<br/>";
    }
  }
  else
  {
    echo "Pas marché";
  }
  $objdb->close();
}
else
{
  echo "Impossible d'ouvrir la base";
}

?>
