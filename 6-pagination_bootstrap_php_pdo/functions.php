<?php

/**
 * Author: Adelino Amaral
 * Date: 29-12-2022
 * Update: 25-01-2023
 */

// Insira as credenciais de uma conta válida no servidor MySQL
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'adelino');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'company');
define('DB_PORT', '3306');

function pdo_connect_mysql()
{
	try {
		$db = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8";
		$link = new PDO($db, DB_USERNAME, DB_PASSWORD);
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $link;
	} catch (PDOException $e) {
		return $e->getMessage();
	}
}



function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Demo Website</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
    		<a href="read.php"><i class="fas fa-address-book"></i>Contacts</a>
    	</div>
    </nav>
EOT;
}


function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
