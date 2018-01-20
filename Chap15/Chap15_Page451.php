<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Lecture de la table article </title>
  <style type="text/css">
  table {border-style:double;border-width:3px;border-color:red;background-color;yellow;} </style>
</head>

<body>
  <?php
  include("connex.inc.php");
  $idcom=connex("magasin","myparam");
  $requete="SELECT id_article AS 'Code Article',designation AS 'Designation',prix AS 'Prix Unitaire',categorie AS 'Categorie' FROM article WHERE designation LIKE '%Sony%' ORDER BY categorie";
  $result=mysql_query($requete,$idcom);

  if(!$result)
  {
    echo "Lecture de la bdd impossible";
  }
  else
  {
    $nbart=mysql_num_rows($result);
    $ligne=mysql_fetch_array($result,MYSQL_ASSOC);

    echo "<h3> Tous nos articles de la marque Sony </h3>";
    echo "<h4> Il y a $nbart articles de la marque Sony </h4>";

    echo "<table border=\"1\"> <tr>";
    foreach($ligne as $nomcol=>$valcol)
    {
      echo "<th> $nomcol </th>";
    }
    echo "</tr>";
    do
    {
      echo "<tr>";
      foreach($ligne as $valcol)
      {
        echo "<td> $valcol </td>";
      }
      echo "</tr>";
    }while($ligne=mysql_fetch_array($result,MYSQL_NUM));
    echo "</table>";

  }
  ?>

</body>

</html>
