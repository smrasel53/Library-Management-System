<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Add Student</span><hr style="margin-top:1px;">
			<?php 
				if (isset($_POST['submit'])) {
					$errors = array();
					if (empty($_POST['name'])) {
						$errors['name'] = "Fullname is required!";
					}
					if (empty($_POST['dept_id'])) {
						$errors['dept_id'] = "Select a department!";
					} 
					if (empty($_POST['roll_no'])) {
						$errors['roll_no'] = "Roll no is required!";
					}
					if (empty($_POST['reg_no'])) {
						$errors['reg_no'] = "Reg. no is required!";
					}
					if (empty($_POST['phone_no'])) {
						$errors['phone_no'] = "Phone number is required!";
					}

					$name = mysqli_real_escape_string($db->link, $_POST['name']);
            		$dept_id = mysqli_real_escape_string($db->link, $_POST['dept_id']);
            		$roll_no = mysqli_real_escape_string($db->link, $_POST['roll_no']);
            		$reg_no = mysqli_real_escape_string($db->link, $_POST['reg_no']);
            		$email = mysqli_real_escape_string($db->link, $_POST['email']);
            		$phone_no = mysqli_real_escape_string($db->link, $_POST['phone_no']);

            		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		          	$file_name = $_FILES['avatar']['name'];
		            $file_size = $_FILES['avatar']['size'];
		            $file_temp = $_FILES['avatar']['tmp_name'];
		           
		            $div = explode('.', $file_name);
		            $file_ext = strtolower(end($div));
		            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		            $uploaded_image = "uploads/students/".$unique_image;

		            if (count($errors) == 0) {
		            	if (!empty($file_name)) {
	          	           if ($file_size > 1048567) {
	          	           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Image size should be less than 1MB!</div>";
	          	           } else if (in_array($file_ext, $permited) === false) {
	          	           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can upload only:- ".implode(', ', $permited)."!</div>";
	          	           } else {
	          		           	$chkrollquery = "SELECT * FROM tbl_students WHERE roll_no = '$roll_no'";
	          		           	$chkroll = $db->select($chkrollquery);
	          		           	$chkregquery = "SELECT * FROM tbl_students WHERE reg_no = '$reg_no'";
	          		           	$chkreg = $db->select($chkregquery);
	          		           	$chkemailquery = "SELECT * FROM tbl_students WHERE email = '$email'";
	          		           	$chkemail = $db->select($chkemailquery);
	          		           	$chkphonequery = "SELECT * FROM tbl_students WHERE phone_no = '$phone_no'";
	          		           	$chkphone = $db->select($chkphonequery);
	          		           	if ($chkroll) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$roll_no</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkreg) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$reg_no</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkemail) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$email</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkphone) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$phone_no</strong> already exist! Try Another One.</div>";
	          		           	} else {
	          		           		move_uploaded_file($file_temp, $uploaded_image);
          		           			$query = "INSERT INTO tbl_students(name, dept_id, roll_no, reg_no, email, phone_no, avatar, created_at) VALUES ('$name', '$dept_id', '$roll_no', '$reg_no', '$email', '$phone_no', '$uploaded_image', now())";
	          		           		 $inserted_rows = $db->insert($query);
	          		           		 if ($inserted_rows) {
	          		           		 	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student Added Successfully...</div>";
	          		           		 	echo "<script>location='http://mindset-station.com/lms/studentlist.php'</script>";
	          		           		 } else {
	          		           		 	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
	          		           		 }
          		           		}
          		           	
          	           		}
                 		} else {
	                 			$chkrollquery = "SELECT * FROM tbl_students WHERE roll_no = '$roll_no'";
	          		           	$chkroll = $db->select($chkrollquery);
	          		           	$chkregquery = "SELECT * FROM tbl_students WHERE reg_no = '$reg_no'";
	          		           	$chkreg = $db->select($chkregquery);
	          		           	$chkemailquery = "SELECT * FROM tbl_students WHERE email = '$email'";
	          		           	$chkemail = $db->select($chkemailquery);
	          		           	$chkphonequery = "SELECT * FROM tbl_students WHERE phone_no = '$phone_no'";
	          		           	$chkphone = $db->select($chkphonequery);
	          		           	if ($chkroll) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$roll_no</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkreg) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$reg_no</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkemail) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$email</strong> already exist! Try Another One.</div>";
	          		           	} else if ($chkphone) {
	          		           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>$phone_no</strong> already exist! Try Another One.</div>";
	          		           	} else {
	                 				$query = "INSERT INTO tbl_students(name, dept_id, roll_no, reg_no, email, phone_no, created_at) VALUES ('$name', '$dept_id', '$roll_no', '$reg_no', '$email', '$phone_no', now())";
		          		            $inserted_rows = $db->insert($query);
		          		            if ($inserted_rows) {
		          		            	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student Added Successfully...</div>";
		          		            	echo "<script>location='http://mindset-station.com/lms/studentlist.php'</script>";
		          		            } else {
		          		            	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
		          		            }
                 				}
          	           		
                 			}
		            	}

		        } 
			 ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Student</div>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name" class="col-sm-2 col-sm-offset-1 control-label">Full Name: </label>
							<div class="col-sm-8">
								<input type="text" name="name" id="name" class="form-control" placeholder="Please enter student name" value="<?php if (isset($_POST['name'])) { echo $_POST['name']; } ?>">
								<span class="error"><?php if (isset($errors['name'])) { echo $errors['name']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="dept_id" class="col-sm-2 col-sm-offset-1 control-label">Department: </label>
							<div class="col-sm-8">
							 <select class="form-control" id="dept_id" name="dept_id">
							 	<option value="0" selected="true">--- Select One ---</option>
							 	<?php 
							 		$query = "SELECT * FROM tbl_depts ORDER BY dept_name ASC";
							 		$result = $db->select($query);
							 		if ($result) {
							 			while ($dept_data = $result->fetch_assoc()) {
							 	 ?>
							    <option value="<?php echo $dept_data['dept_id']; ?>"><?php echo $dept_data['dept_name']; ?></option>
							    <?php } } ?>
							  </select>
							  <span class="error"><?php if (isset($errors['dept_id'])) { echo $errors['dept_id']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="roll_no" class="col-sm-2 col-sm-offset-1 control-label">Roll No.: </label>
							<div class="col-sm-8">
								<input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Please enter roll number" value="<?php if (isset($_POST['roll_no'])) { echo $_POST['roll_no']; } ?>">
								<span class="error"><?php if (isset($errors['roll_no'])) { echo $errors['roll_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="reg_no" class="col-sm-2 col-sm-offset-1 control-label">Reg. No.: </label>
							<div class="col-sm-8">
								<input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Please enter reg number" value="<?php if (isset($_POST['reg_no'])) { echo $_POST['reg_no']; } ?>">
								<span class="error"><?php if (isset($errors['reg_no'])) { echo $errors['reg_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 col-sm-offset-1 control-label">Email: </label>
							<div class="col-sm-8">
								<input type="email" name="email" id="email" class="form-control" placeholder="Please enter email address" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>">
							 </div>
						</div>
						<div class="form-group">
							<label for="phone_no" class="col-sm-2 col-sm-offset-1 control-label">Phone: </label>
							<div class="col-sm-8">
								<input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Please enter phone number" value="<?php if (isset($_POST['phone_no'])) { echo $_POST['phone_no']; } ?>">
								<span class="error"><?php if (isset($errors['phone_no'])) { echo $errors['phone_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="avatar" class="col-sm-2 col-sm-offset-1 control-label">Avatar: </label>
							<div class="col-sm-8">
								<input type="file" name="avatar" class="form-control">
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