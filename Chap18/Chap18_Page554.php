<?php
if($db=new PDO("sqlite:Sportifeuzes.db",SQLITE3_OPEN_READONLY))
{
  $requete="SELECT id_personne AS 'Numéro',nom AS 'Nom',prenom AS 'Prénom',mail FROM personne";
  if($result=$db->query($requete))
  {
    unset($db);
    echo "<h3>Personnes enregistrées</h3>";
    while($tab=$result->fetch(PDO::FETCH_ASSOC))
    {
      foreach($tab as $cle=>$val)
      {
        echo $cle." : &nbsp;&nbsp;".$val."&nbsp;";
      }
      echo "<br/>";
    }
  }
  else
  {
    echo "Connection impossible";
  }
}
else
{
  echo "Erreur ; ".$db->ErrorInfo();
}
?>
