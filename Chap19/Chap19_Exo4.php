<!DOCTYPE html>

<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche dans un xml </title>
  <style tytpe="text/css">
  table {border-style: double;border-width: 4px;border-color: black;background-color: pink;}
  </style>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>RECHERCHE</b> </legend>
      <table>
        <tbody>
          <tr>
            <td>
              Rechercher tous les ;
            </td>
            <td>
              <select name="choix">
                <option value="/iut/etudiant/@nom">Etudiants</option>
                <option value="/iut/etudiant/uv/nom">UV</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="REC" value="ENVOI">
            </td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </form>
</body>

</html>

<?php
if(isset($_POST['REC']))
{
  $choix=$_POST['choix'];
  $xml=simplexml_load_file("iut.xml");
  $result=$xml->xpath($choix);
  $result=array_unique($result);
  echo "<h3> Resultats de Recherche </h3>";
  echo "<ol>";
  foreach($result as $valeur)
  {
    echo "<li>$valeur</li>";
  }
  echo "</ol>";
}
?>
