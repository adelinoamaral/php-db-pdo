<?php
/**
 * Date: 2020-10-05
 * Update: 2022-01-05
 * Author: Adelino Amaral
 */

require_once "utils.php";

// Process form data
if(isset($_POST["id"]) && !empty($_POST["id"])){
   $id = $_POST["id"];
   $result = delete_person($id);
    if($result == 1){
        // Records deleted successfully. Redirect to landing page
        header("location: index.php");
        exit();
    }
    elseif($result == 0){
        echo "Oops! Algo de errado aconteceu. Tente mais tarde.";
    }
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