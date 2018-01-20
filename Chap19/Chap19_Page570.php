<?php
$xml=simplexml_load_file("biblio4.xml");
foreach($xml->children() as $element=>$val)
{
  echo "<h3>".ucfirst($element).": $val </h3>";
  foreach($val->children() as $element=>$val)
  {
    echo "<h4>$element ; </h4> <b>$val</b> <br/>";
    foreach($val->children() as $element=>$val)
    {
      echo "&nbsp;&nbsp; $element ; <b>$val</b> <br/>";
    }
  }
}
?>
