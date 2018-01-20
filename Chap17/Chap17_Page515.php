<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Lecture de la table client </title>
  <style type="text/css">
  table {border-style:double;border-width:10px;border-color:red;background-color: green; }
  </style>
</head>

<body>
  <?php
  include('connexpdo.inc.php');
  $idcom=connexpdo("magasin","myparam");
  $requete="SELECT id_client,nom,prenom,age,adresse,ville,mail FROM client WHERE ville='Paris' ORDER BY nom";
  $result=$idcom->query($requete);
  if(!$result)
  {
    $mes_erreures=$idcom->errorInfo();
    echo "Lecture impossible, code ;".$idcom->errorCode()." correspondant a ;".$mes_erreures[2];
  }
  else
  {
    $nbclient=$result->rowCount();
    $ligne=$result->fetchObject();
    echo "<h3> Il y a $nbclient clients qui habitent a Paris </h3>";
    echo "<table border=\"2\">";
    echo "<tr>";
    foreach($ligne as $cle=>$val)
    {
      echo "<th>$cle</th>";
    }
    echo "</tr>";
    echo "<tr>";
    do
    {
      echo "<td>$ligne->id_client</td> <td>$ligne->nom</td> <td>$ligne->prenom</td> <td>$ligne->age</td> <td>$ligne->adresse</td> <td>$ligne->ville</td> <td>$ligne->mail</td> </tr>";
    } while ($ligne=$result->fetchObject());
    echo "</table>";

    $result->closeCursor();
    $idcom=NULL;
  }
  ?>
</body>

</html>
