<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table article </title>
  <style type="text/css">
  table {border-style:double;border-width:10px;border-color:red;background-color: green; }
  </style>
</head>

<body>
  <?php
  include('connexpdo.inc.php');
  $idcom=connexpdo("magasin","myparam");
  $requete="SELECT id_article,designation,prix,categorie FROM article WHERE designation LIKE '%sony%' ORDER BY categorie";
  $result=$idcom->query($requete);
  if(!$result)
  {
    $mes_erreures=$idcom->errorInfo();
    echo "Lecture impossible, code ;".$idcom->errorCode()." correspondant a ;".$mes_erreures[2];
  }
  else
  {
    $nbart=$result->rowCount();
    $tabresult=$result->fetchAll(PDO::FETCH_ASSOC);
    $titres=array_keys($tabresult[0]);
    echo "<h3> Tous nos articles Sony </h3>";
    echo "<h4> Il y a $nbart </h4>";
    echo "<table border=\"4\">";
    echo "<tr>";
    foreach($titres as $col)
    {
      echo "<th>$col</th>";
    }
    echo "</tr>";
    for($i=0;$i<$nbart;$i++)
    {
      echo "<tr>";
      foreach($tabresult[$i] as $data)
      {
        echo "<td>$data</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
  $result->closeCursor();
  $idcom=NULL;
  ?>
</body>

</html>
