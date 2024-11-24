<?php
include_once "../../configuracion.php";
include_once "../../Control/abmMenu.php";

$obj = new abmMenu();
echo json_encode($obj->armarMenu());
?>