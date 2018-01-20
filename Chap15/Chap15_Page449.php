<!DOCTYPE html>
<html lang="fr">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title> Lecture d'une base de donnée ; magasin,et de sa table article </title>
<style type="text/css">
table {border-style:double;border-width:3px;border-color:red;background-color:yellow;}
</style>
</head>

<body>
<?php
include("connex.inc.php");
$idcom=connex("magasin","myparam");

$requete="SELECT * FROM article ORDER BY categorie";
$result=mysql_query($requete,$idcom);

if(!$result)
{
	echo "Ca a merdé!";
}
else
{
	$nbcol=mysql_num_fields($result);
	$nbart=mysql_num_rows($result);

	echo "<h3> Tous nos articles par catégorie </h3>";
	echo "<h4> Il y a $nbart articles </h4>";

	echo "<table border=\"1\"> <tbody>";
	echo "<tr> <th>Code article</th> <th>Description</th> <th>Prix</th> <th>Categorie</th> </tr>";

	while($ligne=mysql_fetch_array($result,MYSQL_NUM))
	{
		echo "<tr>";
		foreach($ligne as $valeur)
		{
			echo "<td> $valeur </td>";
		}
		echo "</tr>";
	}
	echo "</tbody> </table>";
}

mysql_free_result($result);
?>

</body>
</html>
