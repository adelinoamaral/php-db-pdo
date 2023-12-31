<?php
    /**
     * Date: 2020-10-05
     * Update: 2021-12-04
     * Author: Adelino Amaral
     */
    require_once "config.php";

    $link = connect_db();
    
    /**
     * Ilustra como criar uma base de dados
     */
    try{
        // comando SQL
        $sql = "CREATE DATABASE demo";
        // executa o comando SQL
        $link->exec($sql);

        echo "A base de dados foi criada com sucesso";
    } catch(PDOException $e){
        die("ERRO: ocorreu um erro na execução do comando $sql. " . $e->getMessage());
    }
     
    // Fecha a ligação ao servidor
    unset($link);
?>
