<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche d'un article dans le magasin </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Recherche d'un article </legend>
      <table>
        <tbody>
          <tr>
            <td>
              Mot clé :
            </td>
            <td>
              <input type="text" name="motcle"/>
            </td>
          </tr>
          <tr>
            <td> Dans la catégorie : </td>
            <td>
              <select name="categorie">
                <option value="tous">Tous</option>
                <option value="video">Vidéos</option>
                <option value="informatique">Informatique</option>
                <option value="photo">Photo</option>
                <option value="divers">Divers</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Trier par : </td>
            <td>
              <select name="tri">
                <option value="prix">Prix</option>
                <option value="categorie">Categorie</option>
                <option value="id_article">Code</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>En ordre : </td>
            <td>
              Croissant<input type="radio" name="ordre" value="ASC" checked="checked"/>
              Décroissant<input type="radio" name="ordre" value="DESC" />
            </td>
          </tr>
          <tr>
            <td>Envoyer!</td>
            <td><input type="submit" value="OK!"/></td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['motcle']))
  {
    include('connexobject.inc.php');
    $motcle=$_POST['motcle'];
    $categorie=$_POST['categorie'];
    $ordre=$_POST['ordre'];
    $tri=$_POST['tri'];
    $reqcat=($categorie=='tous')?"":"AND categorie='$categorie'";
    $requete="SELECT id_article AS 'Code Article',designation AS 'Description',prix AS 'Prixce',categorie AS 'Cacategorie' FROM article WHERE lower(designation) LIKE lower('%$motcle%')".$reqcat."ORDER BY $tri $ordre";
    $idcom=connexobject("magasin","myparam");
    $result=$idcom->query($requete);
    if(!$result)
    {
      echo "Lecture caca!";
    }
    else
    {
      $nbcol=$result->field_count;
      $nbart=$result->num_rows;
      $titres=$result->fetch_fields();
      echo "<h3> Il y a $nbart articles correspondant a votre recherche </h3>";
      echo "<table border=\"3\">";
      echo "<tr>";
      foreach($titres as $nomcol=>$val)
      {
        echo "<th>".$titres[$nomcol]->name."</th>";
      }
      echo "</tr>";
      for($i=0;$i<$nbart;$i++)
      {
          $ligne=$result->fetch_row();
          echo "<tr>";
          for($j=0;$j<$nbcol;$j++)
          {
            echo "<td>$ligne[$j]</td>";
          }
          echo "</tr>";
      }
      echo "</table>";
      $result->free();
      $idcom->close();
    }
  }
  ?>
</body>

</html>
