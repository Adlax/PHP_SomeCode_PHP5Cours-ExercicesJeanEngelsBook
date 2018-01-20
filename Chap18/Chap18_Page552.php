<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche de Client </title>
  <style type="text/css">
  div{font-size: 20px;}
  </style>
</head>

<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend> Recherche de client par département </legend>
      <label>Département ; </label> <input type="number" name="depart" /><br/> <!--1-->
      <input type="submit" value="Envoyer"/>
    </fieldset>
  </form>
</body>

</html>

<?php
if(isset($_POST['depart']))
{
  $dep=$_POST['depart'];
  $objdb=new SQLite3('Sportifeuzes.db');
  $objstmt=$objdb->prepare("SELECT id_personne,nom,prenom FROM personne WHERE depart= :dep");
  $objstmt->bindParam(':dep',$dep,SQLITE3_INTEGER);
  $result=$objstmt->execute();
  echo "<div><h3>Clients dans le departement $dep ; </h3><hr/>";
  while($ligne=$result->fetchArray())
  {
    echo "<h3> ID: ".$ligne['id_personne']."&nbsp;".$ligne['nom']."&nbsp;".$ligne['prenom']."</h3>";
  }
  $result->finalize();
  $objdb->close();
  echo "</div>";
}
?>
