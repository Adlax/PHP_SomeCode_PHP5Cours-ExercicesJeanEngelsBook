<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title> Rechercher un client </title>
    <style type="text/css">
        div{font-size: 10px;}
    </style>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
        <legend> Recherche un Client </legend>
        <label>Id_Client ; </label> <input type="number" step="1" name="id_client"/> <br/> <br/>
        <label>Ville ; </label> <input type="text" name="ville"/> <br/>
        <input type="submit" value="ok"/>
        </fieldset>
    </form>
</body>
</html>

<?php
if(isset($_POST['id_client']) && isset($_POST['ville']))
{
    $id_client=$_POST['id_client'];
    $ville=$_POST['ville'];
    include('connexpdo.inc.php');
    $idcom=connexpdo("magasin","myparam");
    $reqprep=$idcom->prepare("SELECT nom,prenom FROM client WHERE id_client>= :id_client AND lower(ville)= :ville");
    $reqprep->bindValue(':ville',$ville,PDO::PARAM_STR);
    $reqprep->bindParam(':id_client',$id_client,PDO::PARAM_INT);
    $reqprep->execute();
    $reqprep->bindColumn('prenom',$prenom);
    $reqprep->bindColumn('nom',$nom);
    echo "<h3> <div> Il y a ".$reqprep->rowCount()." clients qui vivent a ".ucfirst($ville)." et dont l identifiant est sup ou egal a $id_client </h3> <br/>";
    while($result=$reqprep->fetch(PDO::FETCH_BOUND))
    {
        echo "<h3> $prenom $nom <h3/>";
    }
    echo "</div>";
    $reqprep->closeCursor();
    $idcom=NULL;
}
?>
