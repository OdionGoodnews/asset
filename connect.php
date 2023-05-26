<?php 
session_start();
try {
	 $connect = new PDO("mysql:host=localhost; dbname=fpeasset", "root", "");
	 $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	 echo "connection failed!".$e->getMessage();
}






 ?>