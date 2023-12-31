<!-- Export link -->
<div class="col-md-12 head">
    <div class="float-right">
        <a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
    </div>
</div>

<!-- Data list table --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Country</th>
            <th>Created</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
   <?php 
    // Fetch records from database 
    $result = $db->query("SELECT * FROM members ORDER BY id ASC"); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
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
    <?php } ?>
    </tbody>
</table>