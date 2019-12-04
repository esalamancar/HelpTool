<?php
   $svr='localhost:3306';
   $user='phpmyadmin';
   $secret='Mayhem3312*';
   $bd='erick';

   try {
   	$connect= new PDO("mysql:host=$svr;dbname=$bd;", $user, $secret);
   	
   } catch (PDOException $e) {
   	die('Falló la conexión: '.$e->getMessage());
   }
?>