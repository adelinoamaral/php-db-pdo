<?php
require_once "utils.php";

// Obtém o id pela URL
if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
{   
    // obtém o id a pesquisar na tabela
    $id = trim($_GET["id"]);
    // Pesquisa o registo na tabela persons
    $row = read_person($id);
    // Tratamento de erros
    if($row == 0){
        $erro = "O registo que tentou pesquisar não está disponível.";
    }elseif($row == 1){
        $erro = "Problemas no sistema. Contacte o administrador.";
    }

} else{
    // O parâmetro id não veio na URL. Redirecionar para uma página de erro.
    $erro = "Ocorreu um erro. Tente mais tarde.";
    //exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Registo</title>
</head>
<body>
    <?php 
        if(isset($erro))
        {
            echo '<div>';
            echo $erro;
            echo '</div>';
        }
    ?>

    <div>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- Pode utilizar as variáveis definidas acima ou o array associativo -->
                <td scope="row"><?php echo $row["id"]; ?></td>
                <td><?php echo $row["first_name"]; ?></td>
                <td><?php echo $row["last_name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
            </tr>
        </tbody>
        </table>

        <p><a href="index.php">Voltar</a></p>
    </div>        
</body>
</html>