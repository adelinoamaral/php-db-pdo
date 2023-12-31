<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ativação da Conta por Email</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
    /**
     * Confirma a receção do email para
     * Data: 11-02-2022
     */

    // verifica se recebeu os parâmetros key e token a partir do link constante no email
    if ($_GET['key'] && $_GET['token']) {

        include "functions.php";
        $conn = pdo_connect_mysql();

        $email = $_GET['key'];
        $token = $_GET['token'];

        // verifica se o email existe com o respetivo token
        $sql = "SELECT * FROM users WHERE email_verification_link= :token and email= :email";
        if($st = $conn->prepare($sql)){
            $st->bindValue(':token',$token);
            $st->bindValue(':email',$email);
            if($st->execute()){
                // cria a data para verificação do email
                $d = date('Y-m-d H:i:s');
    
                if($st->rowCount()>0){
                    $row = $st->fetch();
                    if ($row['email_verified_at'] == NULL) {
                        // atualiza a data da verificação do email
                        $sqlupdate = "UPDATE users set email_verified_at = :d WHERE email= :email";
                        $stm = $conn->prepare($sqlupdate);
                        $stm->bindParam(':d',$d);
                        $stm->bindParam(':email',$email);
                        $stm->execute();
                        $msg = "Parabéns! O email foi verificado.";
                    } else {
                        $msg = "A conta de email já foi verificada por nós";
                    }
                }else{
                    $msg = "Este email não se encontra registadi!!";
                }

            }
        }
    } else {
        $msg = "Algo muito sério aconteceu. Contacte com o administrador!";
    }
    ?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                A conta do Utilizador foi ativa pela verificação do Email
            </div>
            <div class="card-body">
                <p><?php echo $msg; ?></p>
            </div>
        </div>
    </div>
</body>
</html>