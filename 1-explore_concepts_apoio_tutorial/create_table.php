<?php
/**
 * Date: 2020-10-05
 * Update: 2021-12-04
 * Author: Adelino Amaral
 */
    require_once "config.php";
    $link = connect_db();
   
    try{
        // comando SQL que cria a tabela persons
        $sql = "CREATE TABLE persons(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(30) NOT NULL,
            email VARCHAR(70) NOT NULL UNIQUE
        )";
        // executa o comando SQL
        $link->exec($sql);
        echo "Tabela criada com sucesso.";
    } catch(PDOException $e){
        die("ERRO: Não foi possível executar o comando. " . $e->getMessage());
    }
    
    // Close connection
    unset($link);
?>