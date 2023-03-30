<?php

include_once("../config.php");

$id_banner = $_POST['id_banner'];

$sql2 = $dbh->prepare("DELETE FROM T_banner WHERE idT_banner = $id_banner");
$sql2->execute();
header("Location: http://localhost/criar_banners/view/criar_banner.php");