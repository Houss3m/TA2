<?php

$hostname="localhost";
$username="root";
$password="";
$db_name="multimedia_ta1";

$cnx = new PDO("mysql:host=$hostname;dbname=$db_name", $username,$password);
