<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 */

    require_once "config.php";

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $id_category = $_POST['id_category'];

    $data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'id_category' => $id_category,
      ];  
    
    /* experimentar 
    $data = [
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
    ]; */
    
    $link = connect_db();
    
    try{
        $sql = "INSERT INTO persons (first_name, last_name, email, idCategory) 
                VALUES (:first_name, :last_name, :email, :id_category)";
        $stmt = $link->prepare($sql);
        $stmt->execute($data);
        
        $last_id = $link->lastInsertId();
        echo "Registo $last_id foi inserido com sucesso.";
    } catch(PDOException $e){
        die("ERRO: Não foi possível executar o comando. " . $e->getMessage());
    }
    unset($stmt);
    unset($link);