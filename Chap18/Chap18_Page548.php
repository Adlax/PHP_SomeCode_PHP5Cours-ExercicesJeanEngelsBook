<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table personne </title>
  <style>
  table,td,th{border: 20px solid red; font-size: larger;}
  </style>
</head>

<body>
  <?php
  if($objdb=new SQLite3('Sportifeuzes.db'))
  {
    $requete="SELECT * FROM personne";
    if($result=$objdb->query($requete))
    {
      echo "<h3>Liste des personnes enregistrées</h3>";
      echo "<table> <thead> <tr>";
      $nbcol=$result->numColumns();
      for($i=0;$i<$nbcol;$i++)
      {
        echo "<th>".$result->columnName($i)."</th>";
      }
      echo "</tr> </thead>";
      echo "<tbody>";
      while($ligne=$result->fetchArray(SQLITE3_NUM))
      {
        echo "<tr>";
        for($j=0;$j<$nbcol;$j++)
        {
          echo "<td> $ligne[$j] </td>";
        }
        echo "</tr>";
      }
      echo "</tbody> </table>";
      $result->finalize();
    }
    else
    {
      echo "La requete n'a pas aboutie";
    }
    $objdb->close();
  }
  else
  {
    echo $objdb->lastErrorCode();
  }
  ?>

</body>

</html>
