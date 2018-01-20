<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Lecture de la table client </title>
  <style type="text/css" >
  table {border-style:double;border-width:3px;border-color:red;background-color:yellow;}
  </style>
</head>

<body>
  <?php
  include('connex.inc.php');
  $idcom=connex("magasin","myparam");
  $requete="SELECT id_client AS 'CodeClient',nom,prenom,adresse,mail FROM client WHERE ville='Paris' ORDER BY nom";
  $result=@mysql_query($requete,$idcom);

  if(!$result)
  {
    echo "Lecture impossible";
  }
  else
  {
    $nbcol=mysql_num_fields($result);
    $nbligne=mysql_num_rows($result);
    echo "<h3> Il y a $nbligne entrees dans la requete </h3>";

    echo "<table border=\"1\"> <tr> ";
    for($i=0;$i<$nbcol;$i++)
    {
      echo "<th>",mysql_fetch_field($result,$i)->name,"</th>";
    }
    echo "</tr>";
    for($j=0;$j<$nbligne;$j++)
    {
      $ligne=mysql_fetch_object($result);
      echo "<tr>";
      for($k=0;$k<$nbcol;$k++)
      {
        $nomcol=mysql_fetch_field($result,$k)->name;
        echo "<td>", $ligne->$nomcol ,"</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    mysql_free_result($result);
  }
  ?>
</body>

</html>
