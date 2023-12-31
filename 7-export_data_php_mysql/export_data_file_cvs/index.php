<?php	include 'functions.php'; ?>
<?=template_header('Home')?>

<div class="container">
	<h2 class="mt-4 mb-3">Lista de Contactos</h2>
	<!-- Export link -->
	<div class="col-md-12 head">
		<div class="float-right">
			<a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
		</div>
	</div>
	<?php
		$pdo = connect_db();
		$sql = 'SELECT * FROM members ORDER BY id ASC';
		$results = $pdo->query($sql);
		table_header();
		if($results->rowCount() > 0){ 
			while($row = $results->fetch()){ 
		?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['first_name'].' '.$row['last_name']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['country']; ?></td>
				<td><?php echo $row['created']; ?></td>
				<td><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></td>
			</tr>
		<?php } }else{ ?>
			<tr><td colspan="7">No member(s) found...</td></tr>
		<?php }
		table_footer();
	?>
</div>

<?=template_footer()?>