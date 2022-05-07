<?php

require_once("config.php");

$db = new Sql();

$usuarios = $db->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);