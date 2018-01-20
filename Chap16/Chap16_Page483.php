<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table client </title>
  <style type="text/css">
  table {border-style=double; border-width=3px; border-color=red; background-color=black}
  </style>
</head>

<body>
  <?php
  include_once('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");
  $requete="SELECT id_client AS 'Code_Client',nom,prenom,adresse,age,mail FROM client WHERE ville='Paris' ORDER BY nom";
  $result=$idcom->query($requete);
  if(!$result)
  {
    echo "Chiotte";
  }
  else
  {
    $nbclients=$result->num_rows;
    echo  "Il y a $nbclients clients a Paris";
    //Affichage
    //Affichage titres
    $titres=$result->fetch_object();
    echo "<table border=\"3\">";
    echo "<tr>";
    foreach($titres as $column=>$val)
    {
      echo "<td>$column</td>";
    }
    echo "</tr>";
    //Affichage du Contenu
    $result->data_seek(0);
    //echo "<tr>";
    while($ligne=$result->fetch_object())
    {
      echo "<tr> <td>$ligne->Code_Client</td> <td>$ligne->nom</td> <td>$ligne->prenom</td> <td>$ligne->adresse</td> <td>$ligne->age</td> <td>$ligne->mail</td> </tr>";
    }
    echo "</table>";
    //echo "</tr>";
    $result->free();
    $idcom->close();
  }
  ?>
</body>

</html>
