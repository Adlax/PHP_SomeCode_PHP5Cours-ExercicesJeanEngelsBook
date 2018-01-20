<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table article </title>
  <style type="text/css">
  table {border-style:double;border-width:15px;border-color:black;background-color:red;}
  </style>
</head>

<body>
  <?php
  include('connexpdo.inc.php');
  if($idcom=connexpdo("magasin","myparam"))
  {
    $requete="SELECT * FROM article ORDER BY categorie";
    $result=$idcom->query($requete);
    if(!$result)
    {
      $mes_erreures=$idcom->errorInfo();
      echo "Lecture impossible, code".$idcom->errorCode()." coorespondant a ;".$mes_erreures[2];
    }
    else
    {
      $nbart=$result->rowCount();
      echo "<h3> Tous nos articles par catégorie </h3>";
      echo "<h4> Il y a $nbart articles ; </h4>";
      echo "<table border=\"2\">";
      echo "<tr> <th>Code Article</th> <th>Description</th> <th>Prix</th> <th>Catégorie</th> </tr>";
      while($row=$result->fetch(PDO::FETCH_NUM))
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
    $result->closeCursor();
    $idcom=null;
  }
  ?>
</body>

</html>
