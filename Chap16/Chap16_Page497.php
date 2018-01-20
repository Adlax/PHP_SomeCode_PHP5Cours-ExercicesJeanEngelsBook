<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche de client </title>
  <style type="text/css">
  div { font-size:16px; }
  </style>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Recherche de Client </legend>
      <label> Ville </label>
      <input type="text" name="ville"/> <br/>
      <label> Id_client </label>
      <input type="text" name="id_client"/> <br/>
      <input type="submit" value="Envoyer!"/>
    </fieldset>
  </form>
</body>

</html>


<?php
if(isset($_POST['ville']) && isset($_POST['id_client']))
{
  $ville=strtolower($_POST['ville']);
  $id_client=$_POST['id_client'];
  include('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");
  $reqprep=$idcom->prepare("SELECT prenom,nom FROM client WHERE lower(ville)=? AND id_client>=?");
  $reqprep->bind_param("si",$ville,$id_client);
  $reqprep->execute();
  $reqprep->bind_result($prenom,$nom);
  echo "<div><h3>Clients habitant a ".ucfirst($ville)." dont l'identifiant est superieur ou égal a $id_client</h3>";

  while($reqprep->fetch())
  {
    echo "<h3> $prenom $nom </h3>";
  }
  echo "</div>";
  $reqprep->free_result();
  $idcom->close();
}
?>
