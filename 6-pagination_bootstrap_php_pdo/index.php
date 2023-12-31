<?php

/**
 * Author: Adelino Amaral
 * Date: 29-12-2022
 * Update: 25-01-2023
 */

// Database
require_once('functions.php');
// ligação ao servidor de bases de dados
$connection = pdo_connect_mysql();

// Set session
session_start();
// deve ficar num ficheiro de configuração ao lado das outras constantes
// Foi definido aqui para facilitar a leitura
define("RECORDS_BY_PAGE", 5);

if (isset($_POST['records-limit'])) {
    // guarda o número de registos a visualizar de cada vez (select)
    $_SESSION['records-limit'] = $_POST['records-limit'];
}

// limite de registos por cada pagina
$limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : RECORDS_BY_PAGE;
// escolhe pagina da lista
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$paginationStart = ($page - 1) * $limit;

// obtém os registos compreendidos entre  $paginationStart e $limit
$sql = "SELECT * FROM authors LIMIT $paginationStart, $limit";
$authors = $connection->query($sql)->fetchAll();

// determina o número de registos da tabela authors
$sqlall = "SELECT count(id) AS id FROM authors";
$countAuthors = $connection->query($sqlall)->fetchAll();
$allRecrods = $countAuthors[0]['id'];

// Calcula  total de páginas
$totoalPages = ceil($allRecrods / $limit);

// anterior + próximo
$prev = $page - 1;
$next = $page + 1;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Paginação</title>
    <style>
        .container {
            max-width: 1000px
        }

        .custom-select {
            max-width: 150px
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5">Demonstração de Paginação</h2>

        <!-- Select dropdown -->
        <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="index.php" method="post">
                <select name="records-limit" id="records-limit" class="custom-select">
                    <option disabled selected>Seleciona Limite</option>
                    <?php foreach ([5, 7, 10, 12] as $limit) : ?>
                        <option <?php if (isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?> value="<?= $limit; ?>">
                            <?= $limit; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- Datatable -->
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Apelido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aniversário</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author) : ?>
                    <tr>
                        <th scope="row"><?php echo $author['id']; ?></th>
                        <td><?php echo $author['first_name']; ?></td>
                        <td><?php echo $author['last_name']; ?></td>
                        <td><?php echo $author['email']; ?></td>
                        <td><?php echo $author['birthdate']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) { echo 'disabled';} ?>">
                    <a class="page-link" href="<?php if ($page <= 1) {
                                                    echo '#';
                                                } else {
                                                    echo "?page=" . $prev;
                                                } ?>">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $totoalPages; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) {
                                                echo 'active';
                                            } ?>">
                        <a class="page-link" href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $totoalPages) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page >= $totoalPages) {
                                                    echo '#';
                                                } else {
                                                    echo "?page=" . $next;
                                                } ?>">Seguinte</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // quando selecionar o número de registo submete o formulário
            $('#records-limit').change(function() {
                $('form').submit();
            })
        });
    </script>
</body>

</html>