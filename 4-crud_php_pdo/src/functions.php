<?php
// defined('APPPATH') || define('APPPATH', __DIR__ . DIRECTORY_SEPARATOR);


function connect_db() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'adelino';
    $DATABASE_PASS = '123456';
    $DATABASE_NAME = 'company';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

function template_header($title) 
{
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
    <nav class="nav-t">
    	<div>
    		<h1>Título Website</h1>
EOT;
	if(dirname($_SERVER['PHP_SELF']) == '/php/PHP_DB/versao_pdo/4-crud_php_pdo/src')
	{
		echo "<a href='../public/index.php'><i class='fas fa-home'></i>Início</a>";
	}else{
        echo "<a href='index.php'><i class='fas fa-home'></i>Início</a>";
	}	
echo <<<EOT
    		<a href="../src/read.php"><i class="fas fa-address-book"></i>Contactos</a>
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
?>