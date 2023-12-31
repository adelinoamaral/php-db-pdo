<?php
include 'functions.php';

// Connect to MySQL database
$pdo = connect_db();

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our contacts table, 
// LIMIT will determine the page
$sql = 'SELECT * FROM contacts ORDER BY id LIMIT :current_page, :record_per_page';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether 
// there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();

?>

<?=template_header('Listagem de Contactos')?>

<div class="content read">
	<h2>Lista de Contactos</h2>
	<a href="create.php" class="create-contact">Criar Contacto</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Telefone</td>
                <td>Título</td>
                <td>Criado em</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['name']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['phone']?></td>
                <td><?=$contact['title']?></td>
                <td><?=$contact['created']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit">
                        <i class="fas fa-pen fa-xs"></i>
                    </a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash">
                        <i class="fas fa-trash fa-xs"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
            <a href="read.php?page=<?=$page-1?>">
                <i class="fas fa-angle-double-left fa-sm"></i>
            </a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		    <a href="read.php?page=<?=$page+1?>">
                <i class="fas fa-angle-double-right fa-sm"></i>
            </a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>