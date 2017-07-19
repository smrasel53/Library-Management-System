<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  if (isset($_GET['stu_id'])) {
    $stu_id = $_GET['stu_id'];
  }
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">View Student</span><span class="pull-right"><a href="studentlist.php" class="btn btn-default btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></span><hr style="margin-top:3px;">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-eye" aria-hidden="true"></i> View Student</div>
        <?php 
            $query = "SELECT tbl_students.*, tbl_depts.dept_name FROM tbl_students LEFT JOIN tbl_depts ON tbl_students.dept_id = tbl_depts.dept_id WHERE stu_id = '$stu_id' ";
            $result = $db->select($query);
            if ($result) {
              while ($alldata = $result->fetch_assoc()) {
         ?>
				<div class="panel-body">
					<div class="col-lg-4">
            <?php if ($alldata['avatar']) { ?>
              <img src="<?php echo $alldata['avatar']; ?>" height="250px" width="250px">
            <?php } else { ?>
              <img src="img/avatar.png" height="250px" width="250px">
            <?php } ?>
						<p style="font-size:25px;font-weight:bold;font-family:verdana;text-align: center;"><?php echo $alldata['name']; ?></p>
					</div>
					<div class="col-lg-8 form-horizontal">
					<span style="font-size: 18px; font-weight: bold;">Contact Info</span><hr style="margin-top:1px;">
						<div class="form-group">
							<label class="col-sm-3 control-label">Email: </label>
							<div class="col-sm-5">
								 <?php echo $alldata['email']; ?>
							 </div>
						</div><hr style="border:1px dashed #666;">
						<div class="form-group">
							<label class="col-sm-3 control-label">Phone: </label>
							<div class="col-sm-5">
								 <?php echo $alldata['phone_no']; ?> <span class="label label-success">Active</span>
							 </div>
						</div><hr style="border:1px dashed #666;">
						<div class="form-group">
							<label class="col-sm-3 control-label">Academic Info : </label>
							<div class="col-sm-5">
                <?php echo $alldata['dept_name']; ?> (Department)<br/>
								 <?php echo $alldata['reg_no']; ?> (Reg. No.)<br/>
                 <?php echo $alldata['roll_no']; ?> (Roll No.)
							 </div>
						</div>
					</div>
				</div>
        <?php } } ?>
			</div>
		</div>
	</div>
</div>
<?php include_once 'inc/footer.php'; ?>


