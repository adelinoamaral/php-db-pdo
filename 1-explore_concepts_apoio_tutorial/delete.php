<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 */

// Processa dados do formulário
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";

    // conect to database
    $link = connect_db();
    
    // Prepare a delete statement
    $sql = "DELETE FROM persons WHERE id = :id";
    
    if($stmt = $link->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Algo de errado aconteceu. Tente mais tarde.";
        }
    }
    unset($stmt);
    unset($link);

} else{

    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ver Registo a Remover</title>
</head>

<body>
    <div>
        <div>Apagar Registo</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <!-- Cria-se um campo oculto para passar dados do formulário, neste caso
                o id, importante para o comando SQL -->
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                <p>Tem a certeza de que quer apagar o registo?</p><br>
                <p>
                    <input type="submit" value="Yes">
                    <a href="index.php">No</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>