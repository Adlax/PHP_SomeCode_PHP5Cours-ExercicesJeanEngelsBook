<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Bibliographie </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Bibliographie</b> </legend>
      <table>
        <tbody>
          <tr>
            <td>
              Rechercher tous les ;
            </td>
            <td>
              <select name="choix">
                <option value="titre">Titre</option>
                <option value="auteur">Auteur</option>
                <option value="date">Date</option>
                <option value="@editeur">Editeur</option>
              </select>
            </td>
            <td>
              Dans la cétégorie ;
            </td>
            <td>
              <select name="cat">
                <option value="//ouvrage/livre/">Ouvrages</option>
                <option value="//musique/disque/">Musique</option>
                <option value="//">Tous</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="REC" value="Envoi"/>
            </td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['REC']))
  {
    $choix=$_POST['choix'];
    $cat=$_POST['cat'];
    $xml=simplexml_load_file("biblio4.xml");
    $result=$xml->xpath($cat.$choix);
    $result=array_unique($result);
    echo "<h3> Résultats de la Recherche </h3>";
    echo "<div> <ol>";
    foreach($result as $val);
    {
      echo "<li><big>$val</big></li>";
    }
    echo "</ol></div>";
  }
?>

</body>

</html>
