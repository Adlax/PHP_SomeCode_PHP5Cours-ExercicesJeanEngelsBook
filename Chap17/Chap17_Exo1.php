<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title> Lecture de la table modele </title>
    <style type="text/css">
    table {border-style: double;border-width: 20px;border-color: black;background-color: red;}
    </style>
</head>

<body>
    <?php
    include('connexpdo.inc.php');
    $idcom=connexpdo('voitures','myparam');
    $requete="SELECT id_modele,modele,carburant FROM modele ORDER BY modele";
    $result=$idcom->query($requete);
    if(!$result)
    {
        echo "Lecture impossible";
    }
    else
    {
        $nb=$result->rowCount();
        echo "<h3> Nos modeles de voitures <h3/>";
        echo "<h4> Il y a $nb modeles de voitures ; <h4/>";
        echo "<table border=\"4\">";
        while($ligne=$result->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
            foreach($ligne as $data)
            {
                echo "<td> $data </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    //$result->closeCursor();
    $idcom=NULL;
    ?>
</body>

</html>
