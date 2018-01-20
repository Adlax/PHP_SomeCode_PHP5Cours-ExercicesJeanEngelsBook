<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table article </title>
  <style type="text/css">
  table {border-style=double; border-width=3px; border-color=red; background-color=black}
  </style>
</head>

<body>
  <?php
  include_once('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");
  $requete="SELECT id_article AS 'Code Article',designation AS 'Désignation',prix AS 'Prix Unitaire',categorie AS 'Catégorie' FROM article WHERE lower(designation) LIKE '%sony%' ORDER BY categorie";
  $result=$idcom->query($requete);
/*
  echo "<h1> Affichage du resultat de recherche resultat avec fetch_array </h1>";
  echo "<table border=\"1\">";
  echo "<hr/>";
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
  echo "<hr/>";
*/

  echo "<h1> Affichage du resultat de recherche resultat avec fetch_all </h1>";
  if(!$result)
  {
    echo "Javascript inutile ...ca a foiré!";
  }
  else
  {
    $nbart=$result->num_rows;
    $titres=$result->fetch_fields();
    echo "<h3> Tous les articles sony : </h3>";
    echo "<h4> Il y a $nbart articles sony </h4>";

    echo "<table border=\"5\">";
    //Ligne de titres
    echo "<tr>";
    foreach($titres as $label)
    {
      echo "<th>".htmlentities($label->name)."</th>";
    }
    echo "</tr>";
    //Contenu du resultat de recherche
    $tabresult=$result->fetch_all();
    foreach($tabresult as $ligne)
    {
      echo "<tr>";
      foreach($ligne as $data)
      {
        echo "<td>$data</td>";
      }
      echo "</tr>";
    }
    //fin de table
    echo "</table>";
  }
  $result->free();
  $idcom->close();
  ?>
</body>

</html>
