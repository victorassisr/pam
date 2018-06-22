<?php

$json = file_get_contents("php://input");

$j = json_decode($json);

echo json_encode($j);

?>