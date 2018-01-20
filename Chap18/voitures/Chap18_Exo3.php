<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Affichage du contenu de la table modele </title>
</head>

<body>
  <?php
  $objdb=new SQLite3("voitures.sqlite");
  $requete="SELECT * FROM modele ORDER BY modele ASC";
  $result=$objdb->query($requete);
  if($result)
  {
    echo "<table>";
    echo "<thead> <th>Type</th> <th>Modele</th> <th>Carburant</th> </tr>";
    while($ligne=$result->fetchArray(SQLITE3_NUM))
    {
      echo "<tr> <td>$ligne[0]</td> <td>$ligne[1]</td> <td>$ligne[2]</td> </tr>";
    }
    echo "</table>";
  }?>
</body>

</html>
