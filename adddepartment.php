<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Add Department</span><hr style="margin-top:1px;">
      <?php 
          if (isset($_POST['submit'])) {
            $errors = array();
            if (empty($_POST['dept_name'])) {
              $errors['dept_name'] = "Name is required!";
            }

            $dept_name = mysqli_real_escape_string($db->link, $_POST['dept_name']);
            if (count($errors) == 0) {
              $chkquery = "SELECT * FROM tbl_depts WHERE dept_name = '$dept_name'";
              $chkname = $db->select($chkquery);
              if ($chkname) {
                echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$dept_name</strong> already exist! Try Another One.</div>";
              } else {
                  $query = "INSERT INTO tbl_depts(dept_name) VALUES ('$dept_name')";
                  $inserted_rows = $db->insert($query);
                  if ($inserted_rows) {
                    $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Department Added Successfully...</div>";
                    echo "<script>location='http://mindset-station.com/lms/departmentlist.php'</script>";
                  } else {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
                  }
              }
            }
          }
       ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Department</div>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post">
						<div class="form-group">
							<label for="dept_name" class="col-sm-2 col-sm-offset-1 control-label">Name: </label>
							<div class="col-sm-8">
								<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="Please enter department name" value="<?php if (isset($_POST['dept_name'])) { echo $_POST['dept_name']; } ?>">
                <span class="error"><?php if (isset($errors['dept_name'])) { echo $errors['dept_name']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-offset-1 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" name="submit" class="btn btn-success">Save</button>
							 </div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
 <?php include_once 'inc/footer.php'; ?>