<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 */

    require_once "config.php";

    $link = connect_db();
   
    // Versão de inserção de multiplos registos de forma pura e crua.
    try{
        $sql = "INSERT INTO persons (first_name, last_name, email, idCategory) VALUES
            ('John', 'Rambo', 'johnrambo@mail.com', 1),
            ('Clark', 'Kent', 'clarkkent@mail.com', 1),
            ('John', 'Carter', 'johncarter@mail.com', 1),
            ('Harry', 'Potter', 'harrypotter@mail.com', 1)";      
        $link->exec($sql);
        echo "Dados inseridos com sucesso.";
    } catch(PDOException $e){
        die("ERRO: Não foi possível executar o comando. " . $e->getMessage());
    }

    unset($link);
?>