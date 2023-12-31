<?php

require_once "config.php";

// Devolve o número de registos da tabela perons
function countRowsPersons(){
    $link = connect_db();
    
    // determina o total dos salários
    $sql = "SELECT COUNT(email) as Total FROM persons";
    if ($result = $link->query($sql)){
        $row = $result->fetch();
       return $row['Total'];
    }
}


/**
 * read_person($param_id)
 * Return:
 *  0 - se o registo não foi encontrado
 *  1 - Ocorreu um erro. Tente mais tarde
 * Description: Devolve um registo da tabela persons
 * Date: 5/1/2023
 * Update:
 * 
 */
function read_person($param_id){
    $link = connect_db();

    // Prepara a sentença select
    // O PDO suporta tanto placeholder posicional (?) ou pelo placeholder name (nome)
    $sql = "SELECT * FROM persons WHERE id = :id";
    
    if($stmt = $link->prepare($sql))
    {
        // Liga o placeholder à variável
        $stmt->bindParam(":id", $param_id);
        
        // executa a sentença
        if($stmt->execute())
        {
            // Número de linhas resultante da execução da sentença
            if($stmt->rowCount() == 1)
            {
                /* Obtém um registo como array associativo. */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // devolve um registo em formato de array
                return $row;
            } else{
                return 0;
            }
            
        } else{
            return 1;
        }
    }
     
    unset($stmt);
    unset($link);
}


/**
 * Description: atualiza um registo na tabela persons
 * Date: 5-1-2023
 * Return:
 * 1 - o registo foi atualizado corretamente
 * 0 - ocorreu um erro na atualização do registo
 */
function update_person($dados){
    $link = connect_db();

     // Prepara a setençã
     $sql = "UPDATE persons SET first_name=:first_name, last_name=:last_name, email=:email WHERE id=:id";

     if($stmt = $link->prepare($sql)){
        
         $stmt->bindParam(":first_name", $param_first_name);
         $stmt->bindParam(":last_name", $param_last_name);
         $stmt->bindParam(":email", $param_email);
         $stmt->bindParam(":id", $param_id);
         
         $param_first_name = $dados["first_name"];
         $param_last_name = $dados["last_name"];
         $param_email = $dados["email"];
         $param_id = $dados["id"];
         
         if($stmt->execute())
         {
            return 1;   // Records updated successfully.
         } else{
             return 0;  // Error
         }
     }

    unset($stmt);
    unset($link);
}

/**
 * Description: Delete row on person table
 * Return:
 *  1 - o registo foi eliminado corretamente
 *  0 - ocorreu um erro ao eliminar registo
 * Date: 2023-05-01
 * Author: Adelino Amaral
 */
function delete_person($id){
     // conect to database
     $link = connect_db();
     
     // Prepare a delete statement
     $sql = "DELETE FROM persons WHERE id = :id";
     
     if($stmt = $link->prepare($sql)){
         // Bind variables to the prepared statement as parameters
         $stmt->bindParam(":id", $param_id);
         
         // Set parameters
         $param_id = trim($id);
         
         // Attempt to execute the prepared statement
         if($stmt->execute()){
             return 1;  // Records deleted successfully.
         } else{
             return 0;  // Error
         }
     }
     unset($stmt);
     unset($link);
}