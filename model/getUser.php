<?php

include('config.php');

$sql1 = "SELECT * FROM visiteurs WHERE login = '".$_POST['mail']."'";
$result = $db->prepare($sql1);
$result->execute();
$db = null;
?>