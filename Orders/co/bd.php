<?php
$servidor = 'localhost';
$bd = 'Freshly';
$usuario = 'root';
$contrasenia = '';
$db = new PDO('mysql:host=' . $servidor . ';dbname=' . $bd, $usuario, $contrasenia);
?>