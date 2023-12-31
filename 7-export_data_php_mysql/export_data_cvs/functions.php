<?php
/**
 * Author: Adelino Amaral
 * Date: 29-12-2022
 * Update: 25-01-2023
 */

function connect_db() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'adelino';
    $DATABASE_PASS = '123456';
    $DATABASE_NAME = 'company';
    try {
    	return new PDO(
			'mysql:host=' . $DATABASE_HOST . 
			';dbname=' . $DATABASE_NAME . 
			';charset=utf8', 
			$DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Falhou a conexão à base de dados!');
		return $exception;
    }
}


function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
EOT;
}


function template_footer() {
echo <<<EOT
	<script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
EOT;
}

function table_header(){
	echo <<<EOT
	<table class="table">
  	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nome</th>
			<th scope="col">Email</th>
		</tr>
  	</thead>
	<tbody>
EOT;
}

function table_footer(){
	echo <<<EOT
	</tbody>
	</table>
EOT;
}


function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2030 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
	//???
	// header('Content-Type: application/xls; charset=utf-8');
	header('Content-Type: text/csv; charset=utf-8');
}

?>