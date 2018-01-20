<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Recherche par mot clef d'un article dans le magasin </title>
</head>

<body>
  <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" >
    <fieldset>
      <legend> <b>Rechercher un article</b> </legend>
      <table>
        <tr> <td>Mot-clé: </td> <td><input type="text" name="motcle" size="40" maxlength="40" value=""/></td> </tr>
        <tr> <td>Dans la catégorie : </td>
             <td><select name="categorie">
                 <option value="tous">Tous</option>
                 <option value="video">Videos</option>
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
              <option value="categorie">Catégorie</option>
              <option value="id_article">Code Article</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>En ordre : </td>
          <td>Croissant<input type="radio" name="ordre" value="ASC" checked="checked"/>
              Décroissant<input type="radio" name="ordre" value="DESC"/>
          </td>
        </tr>
        <tr> <td>Envoyer<input type="submit" name="" value="OK"/></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(!empty($_POST['motcle']))
  {
    include('connex.inc.php');
    $motcle=strtolower(mysql_real_escape_string($_POST['motcle']));
    $categorie=mysql_real_escape_string($_POST['categorie']);
    $tri=mysql_real_escape_string($_POST['tri']);
    $ordre=mysql_real_escape_string($_POST['ordre']);

    $reqcategorie=($_POST['categorie']=="tous")?"":"AND categorie='$categorie'";
    $requete="SELECT id_article AS 'Code Article',designation AS 'Description',prix,categorie AS 'Categorie' FROM article WHERE lower(designation) LIKE '%motcle%'".$reqcategorie."ORDER BY $tri $ordre";
    $idcom=connex('magasin','myparam');
    $result=mysql_query($requete,$idcom);
    if(!$result)
    {
      echo "Lecture de la bdd impossible";
    }
    else
    {
      $nbcol=mysql_num_fields($result);
      $nbligne=mysql_num_rows($result);
      echo "<h3> Il y a $nblign articles correspondant a votre recherche, avec votre mot clé : $motcle </h3>";
      echo "<table border=\"1\">";
      echo "<tr>";
      for($i=0;$i<$nbcol;$i++)
      {
        echo "<th>".mysql_field_name($result,$i)."</th>";
      }
      echo "</tr>";
      for($j=0;$j<$nbligne;$j++)
      {
        $ligne=mysql_fetch_row($result);
        echo "<tr>";
        for($k=0;$k<$nbcol;$k++)
        {
          echo "<td>".$ligne[$k]."</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      mysql_free_result($result);
    }
  }
  ?>
</body>

</html>
