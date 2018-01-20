<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-client="Content-Type" content="text/html:charset=UTF-8" />
  <title> Lecture de la table de bdd client </title>
  <style type="text/css" >
  table {border-style:double;border-width:3px;border-color:red;background-color:yellow;}
  </style>
</head>

<body>
  <?php
  include("connex.inc.php");
  $idcom=connex("magasin","myparam");
  $requete="SELECT id_client AS 'Code Client',nom,prenom,adresse,age,mail FROM client WHERE ville='Paris' ORDER BY nom";
  $result=mysql_query($requete,$idcom);

  if(!$result)
  {
    echo "Lecture impossible";
  }
  else
  {
    $nbcol=mysql_num_fields($result);
    $nbart=mysql_num_rows($result);
    echo "<h3> Il y a $nbart clients habitants Paris </h3>";
    echo "<table border=\"1\" > <tr>";
    for($i=0;$i<$nbcol;$i++)
    {
      echo "<th>",mysql_field_name($result,$i),"</th>";
    }
    echo "</tr>";

    for($j=0;$j<$nbart;$j++)
    {
      $ligne=mysql_fetch_row($result);
      echo "<tr>";
      for($k=0;$k<$nbcol;$k++)
      {
        echo "<td>",$ligne[$k],"</td>";
      }
      echo "</tr>";
    }
    echo "</table>";

    mysql_free_result($result);
  }
  ?>
</body>

</html>
