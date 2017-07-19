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
			<span style="font-size: 20px; font-weight: bold;">Edit Student</span><hr style="margin-top:1px;">
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
	          		           	$chkrollquery = "SELECT * FROM tbl_students WHERE roll_no = '$roll_no' AND stu_id != '$stu_id'";
	          		           	$chkroll = $db->select($chkrollquery);
	          		           	$chkregquery = "SELECT * FROM tbl_students WHERE reg_no = '$reg_no' AND stu_id != '$stu_id'";
	          		           	$chkreg = $db->select($chkregquery);
	          		           	$chkemailquery = "SELECT * FROM tbl_students WHERE email = '$email' AND stu_id != '$stu_id'";
	          		           	$chkemail = $db->select($chkemailquery);
	          		           	$chkphonequery = "SELECT * FROM tbl_students WHERE phone_no = '$phone_no' AND stu_id != '$stu_id'";
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
	          		           		$queryImg  = "SELECT * FROM tbl_students WHERE stu_id='$stu_id'";
								    $getImg = $db->select($queryImg);
								    if ($getImg) {
								    	while ($delimg = $getImg->fetch_assoc()) {
								    		$dellink = $delimg['avatar'];
								    		unlink($dellink);
								    	}
								    }
	          		           		move_uploaded_file($file_temp, $uploaded_image);
	          		           		$query = "UPDATE tbl_students 
	          		           				  SET name = '$name',
	          		           				  	dept_id = '$dept_id',
	          		           				  	roll_no = '$roll_no',
	          		           				  	reg_no = '$reg_no',
	          		           				  	email = '$email',
	          		           				  	phone_no = '$phone_no',
	          		           				  	avatar = '$uploaded_image',
	          		           				  	updated_at = now() 
	          		           				  	WHERE stu_id = '$stu_id'";
	          		           		 $updated_rows = $db->update($query);
	          		           		 if ($updated_rows) {
	          		           		 	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student Updated Successfully...</div>";
	          		           		 	echo "<script>location='http://mindset-station.com/lms/studentlist.php'</script>";
	          		           		 } else {
	          		           		 	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
	          		           		 }
          		           		}
          		           	
          	           		}
                 		} else {
	                 			$chkrollquery = "SELECT * FROM tbl_students WHERE roll_no = '$roll_no' AND stu_id != '$stu_id'";
	          		           	$chkroll = $db->select($chkrollquery);
	          		           	$chkregquery = "SELECT * FROM tbl_students WHERE reg_no = '$reg_no' AND stu_id != '$stu_id'";
	          		           	$chkreg = $db->select($chkregquery);
	          		           	$chkemailquery = "SELECT * FROM tbl_students WHERE email = '$email' AND stu_id != '$stu_id'";
	          		           	$chkemail = $db->select($chkemailquery);
	          		           	$chkphonequery = "SELECT * FROM tbl_students WHERE phone_no = '$phone_no' AND stu_id != '$stu_id'";
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
	                 				$query = "UPDATE tbl_students 
	          		           				  SET name = '$name',
	          		           				  	dept_id = '$dept_id',
	          		           				  	roll_no = '$roll_no',
	          		           				  	reg_no = '$reg_no',
	          		           				  	email = '$email',
	          		           				  	phone_no = '$phone_no',
	          		           				  	updated_at = now() 
	          		           				  	WHERE stu_id = '$stu_id'";
	          		           		 $updated_rows = $db->update($query);
	          		           		 if ($updated_rows) {
	          		           		 	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student Updated Successfully...</div>";
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
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Student</div>
				<?php 
					$query = "SELECT * FROM tbl_students WHERE stu_id = '$stu_id'";
					$result = $db->select($query);
					if ($result) {
						while ($stu_data = $result->fetch_assoc()) {
				 ?>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name" class="col-sm-2 col-sm-offset-1 control-label">Full Name: </label>
							<div class="col-sm-8">
								<input type="text" name="name" id="name" class="form-control" placeholder="Please enter student name" value="<?php echo $stu_data['name']; ?>">
								<span class="error"><?php if (isset($errors['name'])) { echo $errors['name']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="dept_id" class="col-sm-2 col-sm-offset-1 control-label">Department: </label>
							<div class="col-sm-8">
							 <select class="form-control" id="dept_id" name="dept_id">
							 	<option value="0" disabled="true" selected="true">--- Select One ---</option>
							 	<?php 
							 		$query = "SELECT * FROM tbl_depts";
							 		$result = $db->select($query);
							 		if ($result) {
							 			while ($dept_data = $result->fetch_assoc()) {
							 	 ?>
							    <option <?php if ($stu_data['dept_id'] == $dept_data['dept_id']) { ?>
                        		selected="selected"
                      			<?php } ?>
                      			value="<?php echo $dept_data['dept_id'] ?>"><?php echo $dept_data['dept_name']; ?></option>
							    <?php } } ?>
							  </select>
							  <span class="error"><?php if (isset($errors['dept_id'])) { echo $errors['dept_id']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="roll_no" class="col-sm-2 col-sm-offset-1 control-label">Roll No.: </label>
							<div class="col-sm-8">
								<input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Please enter roll number" value="<?php echo $stu_data['roll_no']; ?>">
								<span class="error"><?php if (isset($errors['roll_no'])) { echo $errors['roll_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="reg_no" class="col-sm-2 col-sm-offset-1 control-label">Reg. No.: </label>
							<div class="col-sm-8">
								<input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Please enter reg number" value="<?php echo $stu_data['reg_no']; ?>">
								<span class="error"><?php if (isset($errors['reg_no'])) { echo $errors['reg_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 col-sm-offset-1 control-label">Email: </label>
							<div class="col-sm-8">
								<input type="email" name="email" id="email" class="form-control" placeholder="Please enter email address" value="<?php echo $stu_data['email']; ?>">
							 </div>
						</div>
						<div class="form-group">
							<label for="phone_no" class="col-sm-2 col-sm-offset-1 control-label">Phone: </label>
							<div class="col-sm-8">
								<input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Please enter phone number" value="<?php echo $stu_data['phone_no']; ?>">
								<span class="error"><?php if (isset($errors['phone_no'])) { echo $errors['phone_no']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="avatar" class="col-sm-2 col-sm-offset-1 control-label">Avatar: </label>
							<div class="col-sm-8">
								<?php if ($stu_data['avatar']) { ?>
			                      <img src="<?php echo $stu_data['avatar']; ?>" height="250px" width="250px" style="margin-bottom: 5px;">
			                  <?php } else { ?>
			                      <img src="img/male-circle.png" height="250px" width="250px" style="margin-bottom: 5px;">
			                  <?php } ?>
								<input type="file" name="avatar">
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-offset-1 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" name="submit" class="btn btn-success">Save Changes</button>
								<a href="studentlist.php" class="btn btn-default">Cancel</a>
							 </div>
						</div>
					</form>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>
</div>
 <?php include_once 'inc/footer.php'; ?>