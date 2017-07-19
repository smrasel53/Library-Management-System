<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Manage Department</span><hr style="margin-top:1px;">
      <div class="message">
          <?php 
              if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
          ?>
      </div>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-cog" aria-hidden="true"></i> Manage Department</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Sl</th>
								<th>Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
            <?php 
                $query = "SELECT * FROM tbl_depts ORDER BY dept_id DESC";
                $result = $db->select($query);
                if ($result) {
                  $i = 0;
                  while ($dept_data = $result->fetch_assoc()) {
                    $i++;
             ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $dept_data['dept_name']; ?></td>
								<td>
									<a href="editdepartment.php?dept_id=<?php echo $dept_data['dept_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<a href="deletedepartment.php?dept_id=<?php echo $dept_data['dept_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data?'); "><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once 'inc/footer.php'; ?>