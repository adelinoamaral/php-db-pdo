<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 * 
 * Future Update: em caso de erros, criar um ficheiro log que os apresente
 * por: data/hora e tipo de erro
 */

 // Insira as credenciais de uma conta válida no servidor MySQL
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'adelino');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'company');
define('DB_PORT', '3306');


function connect_db()
{
    /**
     * Cria uma ligação ao servidor via PDO (PHP Data Object)
     * 
     * $pdo = new PDO("mysql:host=hostname;dbname=database", "username", "password");
     * Descrição dos parâmetros:
     * localhost - localhost ou IP do servidor MySQL, 
     * username e password - representam as credenciais de acesso ao servidor MySQL
     * database - nome da base dedados.
     * 
     * Cada base de dados requer uma extensão específica. Uma listagem de diversos
     * drives pode ser encontrada em: https://www.php.net/manual/en/pdo.drivers.php
     * 
     */
    try {
        // define a string para o DNS - Data Source Name, com reconhecimento dos
        // caracteres em português utf-8. Podemos usar a porta utilizada no servidor MySQL.
        // $db = "mysql:host=" . DB_SERVER . "; port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8";
        
        $db = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8";

        // Cria uma ligação ao servidor MySQL
        $link = new PDO($db, DB_USERNAME, DB_PASSWORD);

        // Set the PDO error mode to exception
        // Define o atributo PDO::ATTR_ERRMODE como PDO::ERRMODE_EXCEPTION, informa o PDO para 
        // lançar exceções sempre que ocorrer um erro na base de dados.
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Informação do host
        //echo "Ligação realizada com sucesso. Informação do Host: " . $link->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

        // Fecha a ligação à base de dados. Também poderá usar a função unset($link).
        // $link = null;
        // No entanto, a conexão com o servidor de base de dados MySQL será encerrada automaticamente 
        // assim que a execução do script terminar.

        return $link;

    } catch (PDOException $e) {

        // define a mensagem de erro ocorrida
        // Há outros métodos que poderam explorar: 
        //      getCode(), getFile(), getLine(), getTrace(), getTraceAsString()

        //die("ERRO: Não foi possível estabelecer a ligação. " . $e->getMessage());
        return 0;
        // return $e->getMessage();
    }
}

?>