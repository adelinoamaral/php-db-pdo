<?php
/**
 * Date: 2020-10-05
 * Update: 2022-12-04
 * Author: Adelino Amaral
 */

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstname = $lastname = $email = $idcategory = "";
$firstname_err = $lastname_err = $email_err = $idcategory_err = "";

/**
 * Processing form data when form is submitted
 */
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    //$input_firstname = trim($_POST["txtFirstName"]);
    // improve validation
    $input_firstname = (isset($_POST["txtFirstName"]) && $_POST["txtFirstName"] != null) ? trim($_POST["txtFirstName"]) : "";
    if(empty($input_firstname)){
        $firstname_err = "Preencha o nome.";
    }else{
        $firstname = $input_firstname;
    }

    // Validate last name
    $input_lastname = trim($_POST["txtLastName"]);
    if(empty($input_lastname)){
        $lastname_err = "Preencha o apelido.";     
    } else{
        $lastname = $input_lastname;
    }
    
    // Validate salary
    $input_email = trim($_POST["txtEmail"]);
    if(empty($input_email)){
        $email_err = "Preencha o email.";     
    } else{
        $email = $input_email;
    }
    
    $id_category = $_POST['id_category'];

    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err)){

        $link = connect_db();

        // Prepare an insert statement
        $sql = "INSERT INTO persons (first_name, last_name, email, idCategory) 
                VALUES (:firstname, :lastname, :email, :idcategory)";
 
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstname", $param_firstname);
            $stmt->bindParam(":lastname", $param_lastname);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":idcategory", $param_id_category);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_id_category = $id_category;

            /*
                As linhas anteriores poderiam ficar da seguinte forma:
                $stmt->bindParam(':first_name', $_POST['first_name'], PDO::PARAM_STR);
                $stmt->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);
                ...
            */
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

                // Obteriamos o id do registo inserido
                // $last_id = $link->lastInsertId();
                // echo "Registo $last_id foi inserido com sucesso.";

                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Surgiu um problema. Por favor, tente mais tarde.";
            }
        }
         
        // Close statement
        unset($stmt);
        // Close connection
        unset($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
</head>
<body>
    <div>Cria Registo</div>
    <p>Preencha os campos.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Nome</label>
            <input type="text" name="txtFirstName" value="<?php echo $firstname; ?>">
            <span><?php echo $firstname_err;?></span>
        </div>
        <div>
            <label>Apelido</label>
            <input type="text" name="txtLastName"><?php echo $lastname; ?></input>
            <span><?php echo $lastname_err;?></span>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="txtEmail" value="<?php echo $email; ?>">
            <span><?php echo $email_err;?></span>
        </div>
        <div>
            <label>ID Categoria</label>
            <input type="text" name="id_category" value="<?php echo $idcategory; ?>">
            <span><?php echo $idcategory_err;?></span>
        </div>
        <div>
            <input type="submit" value="Enviar">
            <a href="index.php">Cancelar</a>
        </div>
    </form>
      
</body>
</html>