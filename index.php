<?php

require_once("config.php");

$user = new User;




$user->loadById(3);

echo $user;