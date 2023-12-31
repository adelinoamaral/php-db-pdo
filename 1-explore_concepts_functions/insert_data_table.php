<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 */

    require_once "config.php";
    $link = connect_db();
    try{
        $sql = "INSERT INTO persons (first_name, last_name, email, idCategory) 
                VALUES ('Diogo', 'Gomes', 'dg@mail.com', 1)";    
        $link->exec($sql);
        echo "Dados inseridos com sucesso.";
    } catch(PDOException $e){
        die("ERRO: Não foi possível executar o comando. " . $e->getMessage());
    }

    unset($link);
?>