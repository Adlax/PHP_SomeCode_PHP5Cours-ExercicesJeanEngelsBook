<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <title> Lecture du fichier xml iut </title>
  <style type="text/css">
  table {border-style: double;border-width: 5px;border-color: red;background-color: pink;}
  </style>
</head>

<body>
  <?php
  $xml=simplexml_load_file("iut.xml");
  echo "<table border=\"4\" width=\"80%\">";
  foreach($xml->etudiant as $valeur)
  {
    echo "<tr> <th>Nom de l etudiant : ".$valeur['nom']."</th> <th>Identifiant : ".$valeur['id']."</th> </tr>";
    foreach($valeur->uv as $valeur)
    {
      echo "<tr> <td>Nom de l uv : </td> <td>".$valeur->nom."</td> </tr>";
      echo "<tr> <td>Duree de l uv: </td> <td>".$valeur->duree."</td> </tr>";
      echo "<tr> <td>Note de l uv : </td> <td>".$valeur->note."</td> </tr>";
    }
  }
  echo "</table>";
  ?>
</body>
</html>
