<?php

include ('Valite.php');

$valite = new Valite();
$valite->setImage('ceshi.jpeg');
$valite->getHec();
$ert = $valite->run();
//$ert = "1234";
print_r($ert);
echo '<br><img src="ceshi.jpeg"><br>';

?>