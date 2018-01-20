<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Select un modele disponible dans la table des modeles </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Liste des modeles dispos </legend>
      <select name="modele">
        <?php
        $objdb=new PDO("sqlite:voitures.sqlite",SQLITE3_OPEN_READONLY);
        $requete="SELECT modele FROM modele ORDER BY modele ASC";
        $result=$objdb->query($requete);
        while($ligne=$result->fetch(PDO::FETCH_NUM))
        {
          echo "<option value=\"$ligne[0]\">$ligne[0]</option>";
        }
        ?>
      </select>
      <input type="submit" value="Enregistrer"/>
    </fieldset>
  </form>
</body>

</html>
