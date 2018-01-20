<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content" content="text/html;charset=UTF-8"/>
  <title> Insertion et lecture dans la table client </title>
</head>

<body>
  <?php
  include_once('connexpdo.inc.php');
  $idcom=connexpdo("magasin","myparam");
  $requete1="UPDATE client SET age=26 WHERE id_client=7";
  $nb=$idcom->exec($requete1);
  echo "<p> $nb ligne(s) modifiée(s) <hr/> </p>";
  $requete2="SELECT * FROM client ORDER BY nom";
  $result=$idcom->query($requete2);
  if(!$result)
  {
    $mes_erreures=$idcom->errorInfo();
    echo "Lecture impossible, erreur code ;".$idcom->errorCode()." correspondant a ;".$mes_erreures[2];
  }
  else
  {
    while($ligne=$result->fetch(PDO::FETCH_NUM))
    {
      foreach($ligne as $data)
      {
        echo $data."&nbsp;";
      }
      echo "<hr/>";
    }
    $result->closeCursor();
  }
  $idcom=null;
  ?>
</body>

</html>
