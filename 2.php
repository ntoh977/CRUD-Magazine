<?php  

$db = mysqli_connect('localhost', 'root', '', 'prictik');
$sql = mysqli_query($db, "DELETE FROM `practika` WHERE `id`='" . $_GET['id'] ."'");
header("Location: /");