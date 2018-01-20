<?php
if(isset($_COOKIE['nom']) && isset($_COOKIE['prenom']) )
{
  $nom=$_COOKIE['nom'];
  $prenom=$_COOKIE['prenom'];
  $message="<h3> Bonjour $prenom $nom !</h3>";
  $lien1="<a href=\"recherche.php\" title=\"Recherche\"><button type=\"button\"> Rechercher des partenaires </button></a>";
  $lien2="<a href=\"ajout.php\" title=\"S'inscrire ou Ajouter\"><button type=\"button\"> S'inscrire/Ajouter un sport </button></a>";
}

if(isset($_POST['mail']))
{
  $mail=strtolower($_POST['mail']);
  $objdb=new SQLite3("sportifs.sqlite");
  $requete="SELECT id_pers,nom,prenom FROM personnes WHERE mail='$mail'";
  $result=$objdb->query($requete);
  $ligne=$result->fetchArray();
  if(!empty($ligne))
  {
    $message="<h3> Bonjour $ligne[2] $ligne[1] </h3>";
    $lien1="<a href=\"recherche.php\" title=\"Recherche\"><button type=\"button\"> Rechercher des partenaires </button></a>";
    $lien2="<a href=\"ajout.php\" title=\"S'inscrire ou Ajouter\"><button type=\"button\"> S'inscrire/Ajouter un sport </button></a>";
    setcookie('nom',$ligne[1],time()+30*24*3600);
    setcookie('prenom',$ligne[2],time()+30*24*3600);
  }
  else
  {
    echo "Vous n etes pas dans le registre!<br/>";
  }
}

include_once('en_tete.php');
$objdb=new SQLite3("sportifs.sqlite");
$requete="SELECT design FROM sports ORDER BY design ASC";
$result=$objdb->query($requete);
echo "<div style=\" position:absolute;left:0px;width:20%;background-color:#CCFF66\">";
echo "<b> Liste des sports existants</b><br /><br />";
while($ligne=$result->fetchArray(SQLITE3_NUM))
{
 echo ucfirst($ligne[0]),"<br />";
}
echo "<br/>";
echo "</div>";
?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset>
    <legend> Identification </legend>
    <label> Votre mail ; </label> <input type="text" name="mail" />
    <input type="submit" value="REC" />
  </fieldset>
</form>
<a href=\"ajout.php\" title=\"S'inscrire ou Ajouter\"><button type=\"button\"> S'inscrire/Ajouter un sport </button></a>
<br/>
<br/>

<div style=\"position:absolute;right:300px;width:80%;background-color:#FFFFFF;\">
  <?php
  if(isset($message))
  {echo $message;}
  echo "<table> <tbody>";
  echo "<tr>";
  echo "<th><b>Vous pourez faire une recherche ou vous inscrire a un nouveau sport lorsque vous serez identifie</b></th>";
  echo "</tr>";
  echo "</tbody> </table>";
  if(isset($lien1) && isset($lien2) )
  {echo "$lien1 &nbsp;&nbsp;&nbsp;&nbsp; $lien2";}
  ?>
</div>

</body>

</html>
