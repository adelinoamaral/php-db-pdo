<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'adelino';
    $DATABASE_PASS = '123456';
    $DATABASE_NAME = 'demo';
    try {
    	return new PDO(
			'mysql:host=' . $DATABASE_HOST . 
			';dbname=' . $DATABASE_NAME . 
			';charset=utf8', 
			$DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Falhou a conexão à base de dados!');
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
?>