<?php


function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'adelino';
    $DATABASE_PASS = '123456';
    $DATABASE_NAME = 'company';
    try {
    	$link = new PDO(
			'mysql:host=' . $DATABASE_HOST . 
			';dbname=' . $DATABASE_NAME . 
			';charset=utf8', 
			$DATABASE_USER, $DATABASE_PASS);
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $link;
    } catch (PDOException $e) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Falhou a conexão à base de dados!' . $e->getMessage());
		return $e->getMessage();
    }
}
