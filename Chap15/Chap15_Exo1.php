<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Lecture de modele </title>
  <style type="text/css">
  table {border-style:double;border-width:3px;border-color:blue;background-color:#FFCCEE;}
  </style>
</head>

<body>
  <?php
  include("connex.inc.php");
  $idcom=connex("voitures","myparam");
  $requete="SELECT * FROM modele ORDER BY modele";
  $result=mysql_query($requete,$idcom);
  if(!$result)
  {
    echo "Pas de resultat";
  }
  else
  {
    $nbcol=mysql_num_fields($result);
    $nbligne=mysql_num_rows($result);
    echo "<h3> Il y a $nbligne modeles </h3>";
    echo "<table border=\"1\">";
    echo "<tr>";
    echo "<th>Modele</th> <th>Marque</th> <th>Carburant</th>";
    echo "</tr>";
    while($ligne=mysql_fetch_array($result,MYSQL_NUM))
    {
      echo "<tr>";
      foreach($ligne as $valeur)
      {
        echo "<td>$valeur</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
  ?>
</body>

</html>
