<?php
include 'functions.php';
$pdo = connect_db();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // select record to delete
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('O contacto não existe com esse ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Contacto Eliminado!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('ID não especificado!');
}
?>


<?=template_header('Apagar Contacto')?>
<div class="content delete">
	<h2>Apagar Contacto #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Tem a certeza que pretende apagar o contacto #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>
<?=template_footer()?>

