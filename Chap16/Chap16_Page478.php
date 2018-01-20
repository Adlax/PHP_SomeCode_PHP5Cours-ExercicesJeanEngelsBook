<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table article </title>
  <style type="text/css">
  table {border-style:triple; border-width;5px; border-color:black; background-color:green; }
  </style>
</head>

<body>
  <?php
  include_once('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");
  $requete="SELECT * FROM article ORDER BY categorie";
  $result=$idcom->query($requete);
  if(!$result)
  {
    echo "Crotte!";
  }
  else
  {
    $nbart=$result->num_rows;
    echo "<h3> Il y a $nbart articles dans la table article </h3>";
    echo "<table border=\"3\" >";
    echo "<tr> <th>Code Article</th> <th>Description</th> <th>Prix</th> <th>Categorie</th> <tr>";
    while($row=$result->fetch_array(MYSQLI_NUM))
    {
      echo "<tr>";
      foreach($row as $data)
      {
        echo "<td>$data</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
  $result->free();
  $idcom->close();
  ?>
</body>

</html>
