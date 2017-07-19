<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Manage Student</span><hr style="margin-top:1px;">
      <div class="message">
          <?php 
              if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
          ?>
      </div>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-cog" aria-hidden="true"></i> Manage Student</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Avatar</th>
								<th>Full Name</th>
                <th>Roll No.</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
            <?php 
                $query = "SELECT * FROM tbl_students ORDER BY stu_id DESC";
                $result = $db->select($query);
                if ($result) {
                  while ($stu_data = $result->fetch_assoc()) {
             ?>
							<tr class="odd gradeX">
								<td>
                  <?php if ($stu_data['avatar']) { ?>
                      <img src="<?php echo $stu_data['avatar']; ?>" height="30px" width="40px">
                  <?php } else { ?>
                      <img src="img/male-circle.png" height="30px" width="40px">
                  <?php } ?>
                </td>
								<td><?php echo $stu_data['name']; ?></td>
                <td><?php echo $stu_data['roll_no']; ?></td>
								<td>
									<a href="viewstudent.php?stu_id=<?php echo $stu_data['stu_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="editstudent.php?stu_id=<?php echo $stu_data['stu_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<a href="deletestudent.php?stu_id=<?php echo $stu_data['stu_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
