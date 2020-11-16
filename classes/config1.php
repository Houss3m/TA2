<?php

$hostname="localhost";
$username="root";
$password="";
$db_name="multimedia_ta2";

$cnx = new PDO("mysql:host=$hostname;dbname=$db_name", $username,$password);
