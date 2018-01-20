<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche un article en magasin </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" mathod="post">
    <fieldset>
      <legend> <b>Recherche article par mot cle</b> </legend>
      <table>
        <tbody>
          <tr>
            <td>
              Mot clef ;
            </td>
            <td>
              <input type="text" name="motcle" size="30" maxlength="40" />
            </td>
          </tr>
          <tr>
            <td>
              Categorie ;
            </td>
            <td>
              <select name="categorie" >
                <option value="tous">Tous</option>
                <option value="vidéo">Vidéos</option>
                <option value="photo">Photo</option>
                <option value="informatique">Informatique</option>
                <option value="divers">Divers</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              Trier par ;
            </td>
            <td>
              <select name="tri">
                <option value="id_article">Id_Article</option>
                <option value ="prix">Pris</option>
                <option value="categorie">Categorie</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              Ordre ;
            </td>
            <td>
              Croissant<input type="radio" name="ordre" value="ASC" checked="checked"/>
              Décroissant<input type="radio" name="ordre" value="DESC" />
            </td>
          </tr>
          <tr>
            <td><input type="submit" name="" value="Envoyer!"/></td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </form>

  <?php
  if(!empty($_POST['motcle']))
  {
    include('connexpdo.inc.php');
    $motcle=$_POST['motcle'];
    $categorie=$_POST['categorie'];
    $tri=$_POST['tri'];
    $ordre=$_POST['ordre'];
    $reqcategorie=($categorie=="tous")?"":"AND categorie='$categorie'";
    $requete="SELECT id_article,designation,prix,categorie FROM article WHERE lower(designation) LIKE '%$motcle%'".$reqcategorie."ORDER BY $tri $ordre";

    $idcom=connexpdo("magasin","myparam");
    $result=$idcom->query($requete);

    if(!$result)
    {
      echo "ca a merdé!";
    }
    else
    {
      $nbcol=$result->columnCount();
      $nbart=$result->rowCount();
      if($nbart==0)
      {
        echo "Pas de résultats";
        exit;
      }
      $ligne=$result->fetch(PDO::FETCH_ASSOC);
      $titres=array_keys($ligne);
      $ligne=array_values($ligne);
      echo "<h3>Il y a $nbart articles correspondants a votre recherche</h3>";
      echo "<table border=\"4\">";
      echo "<tr>";
      foreach($titres as $val)
      {
        echo "<th>$val</th>";
      }
      echo "</tr>";
      do
      {
        echo "<tr>";
        foreach($ligne as $data)
        {
          echo "<td>$data</td>";
        }
        echo "</tr>";
      } while ($ligne=$result->fetch(PDO::FETCH_ASSOC));
      echo "</table>";
      $result->closeCursor();
      $idcom=NULL;
    }
  }
  ?>
</body>

</html>
