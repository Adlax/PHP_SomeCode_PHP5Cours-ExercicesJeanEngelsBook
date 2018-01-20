<?php
if($objdb=new SQLite3('Sportifeuzes.db'))
{
  echo "La base Sportifs est crée et ouverte <br/>";

  $reqpersonne="CREATE TABLE IF NOT EXISTS personne(id_personne INTEGER PRIMARY KEY AUTOINCREMENT,nom VARCHAR(20) NOT NULL,prenom VARCHAR(20),depart INTEGER(2) NOT NULL,mail VARCHAR(20) NOT NULL)";
  if($objdb->query($reqpersonne))
  {
    echo "la table est crée <br/>";
  }
  else
  {
    echo $objdb->lastErrorMsg();
  }

  $reqsport="CREATE TABLE IF NOT EXISTS sport(id_sport INTEGER PRIMARY KEY AUTOINCREMENT,design VARCHAR(20) UNIQUE NOT NULL)";
  if($objdb->query($reqsport))
  {
    echo "la table est crée <br/>";
  }
  else
  {
    echo $objdb->lastErrorMsg();
  }

  $reqpratique="CREATE TABLE IF NOT EXISTS pratique(id_personne INTEGER NOT NULL,id_sport INTEGER NOT NULL,niveau TINYINT,PRIMARY KEY(id_personne,id_sport))";
  if($objdb->query($reqpratique))
  {
    echo "la table est crée <br/>";
  }
  else
  {
    echo $objdb->lastErrorMsg();
  }
}
else
{
  echo "ERREUR de connexion";
}
?>
