<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche des proprietaires d'un modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Entrez un modele </legend>
      <table>
        <tr> <td>Marque ; </td> <td><input text="text" name="modele" size="30"></td> </tr>
        <tr> <td>Soumettrre la requete quequette!</td> <td><input type="submit" value"Chercher!"></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['modele']))
  {
    include('connexobject.inc.php');
    $idcom=connexobject("voitures","myparam");
    $modele=$_POST['modele'];
    $requeteprep=$idcom->prepare("SELECT proprietaire.nom,proprietaire.prenom FROM proprietaire,cartegrise,voitures,modele WHERE modele=? AND proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele");
    $requeteprep->bind_param("s",$modele);
    $requeteprep->execute();
    $requeteprep->bind_result($nom,$prenom);
    echo "<table>";
    while($requeteprep->fetch())
    {
      echo "<tr> <td>$nom</td> <td>$prenom</td> </tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "<h3>Veuillez remplir le formulaire</h3>";
  }
  ?>

</body>

</html>
