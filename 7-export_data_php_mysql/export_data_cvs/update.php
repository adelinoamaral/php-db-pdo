<?php
include 'functions.php';
$pdo = connect_db();
$msg = '';

// Check if the contact id exists, for example update.php?id=1 
// will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record 
        // and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'Atualizado com Sucesso!';
    }
    // Get the contact from the contacts table
    $sql = 'SELECT * FROM contacts WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('O Contacto não existe com esse ID!');
    }
} else {
    exit('O ID não foi especificado!');
}
?>

<?=template_header('Atualização')?>

<div class="content update">
	<h2>Atualiza o contacto #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Nome</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" placeholder="Adelino Amaral" value="<?=$contact['name']?>" id="name">
        <label for="email">Email</label>
        <label for="phone">Telefone</label>
        <input type="text" name="email" placeholder="am@example.com" value="<?=$contact['email']?>" id="email">
        <input type="text" name="phone" placeholder="225550143" value="<?=$contact['phone']?>" id="phone">
        <label for="title">Cargo</label>
        <label for="created">Criado em</label>
        <input type="text" name="title" placeholder="cargo" value="<?=$contact['title']?>" id="title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($contact['created']))?>" id="created">
        <input type="submit" value="Atualizar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>