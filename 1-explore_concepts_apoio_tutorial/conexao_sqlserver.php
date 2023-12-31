<?php
/*****
 * Conexão usando uma porta específica no sqlserver
 * $serverName = "(local), 1521";  
   $database = "AdventureWorks";  
   $conn = new PDO( "sqlsrv:server=$serverName;Database=$database", "", "");
 */


try {  
   $conn = new PDO( "sqlsrv:Server=(local);Database=AdventureWorks", NULL, NULL);   
   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
  
catch( PDOException $e ) {  
   die( "Error connecting to SQL Server" );   
}  
  
echo "Está ligado ao SQL Server\n";  
  
$query = 'select * from Person.ContactType';   
$stmt = $conn->query( $query );   
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){   
   print_r( $row );   
}  
?>