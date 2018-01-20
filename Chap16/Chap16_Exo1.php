<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title> Lecture de la table Modele </title>
  <style type="text/css">
  table { border-style:double; border-width:3px; border-color:green; border-background:black;}
  </style>
</head>

<body>
  <?php
  include('connexobject.inc.php');
  $idcom=connexobject("voitures","myparam");
  $requete="SELECT id_modele,modele,carburant FROM modele ORDER BY modele";
  $result=$idcom->query($requete);
  if(!$result)
  {
    echo "Lecture impossible";
  }
  else
  {
    $nbart=$result->num_rows;
    $titres=$result->fetch_fields();
    echo "<h3> Tous les modeles de voitures </h3>";
    echo "<h4> Il y a $nbart articles dans la table modele </h4>";
    echo "<table border=\"1\">";
    echo "<tr>";
    foreach($titres as $column)
    {
      echo "<th>$column->name</th>";
    }
    echo "</tr>";
    while($ligne=$result->fetch_array(MYSQLI_NUM))
    {
      echo "<tr>";
      foreach($ligne as $val)
      {
        echo "<td>$val</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
  $result->free_result();
  $idcom->close();
  ?>
</body>

</html>
