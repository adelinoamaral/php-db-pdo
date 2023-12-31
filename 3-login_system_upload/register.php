<?php
include 'utils_interfaces.php';
require_once "utils_db.php";

$link = pdo_connect_mysql();
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Insira o nome do utilizador.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O nome de utilizador só pode conter letras, algarismos e underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "O nome de utilizador já se encontra registado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo aconteceu. Por favor tente de novo.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Insira a senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas não coincidem.";
        }
    }

    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array(
            "jpg" => "image/jpg", 
            "jpeg" => "image/jpeg", 
            "gif" => "image/gif", 
            "png" => "image/png"
        );
        // saves name, typr and size file
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) $uploadfile_err = "Erro: Insira um ficheiro num formato válido.";
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) $uploadfile_err = "Erro: O tamanho do ficheiro ultrapassa o limite permitido.";
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $filename)){

                // CODIFICAR O NOME DO FICHEIRO PARA QUE SEJA ÚNICO

                $uploadfile_err = "O ficheiro " . $filename . " já existe.";
            }
        } else{
            $uploadfile_err = "Erro: existe problemas com o carregamento do ficheir. Tente novamente!";
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }


    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($uploadfile_err)){
        
        /*
            Creates a password hash
            a função password_hash() cria um hash a partir da inserida pelo utilizador.
            Dois utilizadores com as mesmas senhas, os hashes de senha serão diferentes. 
        */
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            ":username" => $username,
            ":password" => $param_password,
            ":idcategory" => $_POST['categories'],
            ":photo" => $filename, 
        ];

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, photo, created_at, idcategory) VALUES (:username, :password, :photo, NOW(), :idcategory)";
         
        if($stmt = $link->prepare($sql)){            
            // Attempt to execute the prepared statement
            if($stmt->execute($data)){

                if(!file_exists(NAME_DIRECORY_UPLOAD . $filename)){
                    // move the file to the upload directory
                    move_uploaded_file($_FILES["photo"]["tmp_name"], NAME_DIRECORY_UPLOAD . $filename);
                }
                
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Algo aconteceu. Por favor tente de novo.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($link);
}

?>

<?=template_header('Atualização', false)?>

<div class="container">
    <h2>Criar Conta</h2>
    <p>Preencha o formulário para criar a conta.</p>
    <?php
        if(!empty($username_err) || !empty($password_err) 
            || !empty($confirm_password_err) || !empty($uploadfile_err)){
                echo $username_err . " - " . $password_err  . " - " . $confirm_password_err . " - " . $uploadfile_err;
            }
    ?>
    <!-- class="needs-validation" novalidate -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-2">
            <labelfor="idnome">Nome de Utilizador</label>
            <input type="text" name="username" value="<?php echo $username; ?>" id="idnome" >
            <div><?php echo $username_err; ?></div>
        </div>

        <div class="mb-2">
            <label for="idsenha">Senha</label>
            <input type="password" name="password"
                value="<?php echo $password; ?>" id="idsenha" required>
            <div><?php echo $password_err; ?></div>
        </div>
        <div class="mb-2">
            <label class="form-label" for="idsenhaconfirma">Confirme Senha</label>
            <input type="password" name="confirm_password"
                value="<?php echo $confirm_password; ?>" id="idsenhaconfirma" required>
            <span><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="mb-2">
            <label for="fileSelect">Escolha a imagem:</label>
            <input type="file" accept="image/*" id="photo" name="photo" onchange="getImgData();" />
            <div id="img-preview"></div>
        </div>

        <div class="mb-2">
            <label class="form-label" for="idCategory">Categoria</label>
            <select name="categories">
                <?php
                    $sql = "SELECT * FROM categories";
                    $result = $link->query($sql);
                    if ($result){
                        while ($row = $result->fetch()) {
                            echo "<option value='" . $row['idcategory'] .  "'>" . $row['assignment'] . "</options>";
                        }
                    }
                    unset($link);
                ?>
            </select>
        </div>

        <div class="mb-2">
            <input type="submit" value="Registar">
            <input type="reset" value="Limpar">
        </div>
        <p>Já tem uma conta? <a href="login.php">Faça Login Aqui</a>.</p>
    </form>
</div>

<script>
    const getImgData = () => {
        const chooseFile = document.getElementById("photo");
        const imgPreview = document.getElementById("img-preview");
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });    
        }
    }
</script>

<?=template_footer()?>