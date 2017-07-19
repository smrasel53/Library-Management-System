<?php 
	$filepath = dirname(__FILE__);
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	$adminId = Session::get("adminId");
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Profile</span><hr style="margin-top:3px;">
				<?php 
					if (isset($_POST['submit'])) {
				       $fname = mysqli_real_escape_string($db->link, $_POST['fname']);
				       $lname = mysqli_real_escape_string($db->link, $_POST['lname']);
				       $email = mysqli_real_escape_string($db->link, $_POST['email']);

			           $permited  = array('jpg', 'jpeg', 'png', 'gif');
			           $file_name = $_FILES['avatar']['name'];
			           $file_size = $_FILES['avatar']['size'];
			           $file_temp = $_FILES['avatar']['tmp_name'];
			           
			           $div = explode('.', $file_name);
			           $file_ext = strtolower(end($div));
			           $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			           $uploaded_image = "uploads/".$unique_image;

			           if (!empty($file_name)) {
				           if ($file_size > 1048567) {
				           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Image size should be less than 1MB!</div>";
				           } else if (in_array($file_ext, $permited) === false) {
				           		echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can upload only:- ".implode(', ', $permited)."!</div>";
				           } else {
					           	move_uploaded_file($file_temp, $uploaded_image);
					           	$query = "UPDATE tbl_admin
			                             SET
			                             fname = '$fname',
			                             lname = '$lname',
			                             email = '$email',
			                             avatar = '$uploaded_image'
			                             WHERE adminId='$adminId'";
					            $updated_rows = $db->update($query);
					            if ($updated_rows) {
					            	echo "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Profile Updated Successfully...</div>";
					            } else {
					            	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
					            }
				           }
			       		} else {
				           	$query = "UPDATE tbl_admin
			                         SET
			                         fname = '$fname',
			                         lname = '$lname',
			                         email = '$email'
			                         WHERE adminId='$adminId'";
				            $updated_rows = $db->update($query);
				            if ($updated_rows) {
				            	echo "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Profile Updated Successfully...</div>";
				            } else {
				                echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
				            }
			       		}
			   		}
				 ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i> Profile</div>
				<div class="panel-body">
					<?php 
						$query = "SELECT * FROM tbl_admin WHERE adminId = '$adminId'";
						$result = $db->select($query);
						if ($result) {
							while($adminData = $result->fetch_assoc()) {
					?>
					<form action="" method="post" enctype="multipart/form-data">
					<div class="col-lg-4">
						<p style="font-size:25px;font-weight:bold;font-family:verdana;text-align: center;"><?php echo $adminData['fname'].' '.$adminData['lname']; ?></p>
						<?php if ($adminData['avatar']) { ?>
							<img src="<?php echo $adminData['avatar']; ?>" height="250px" width="250px">
						<?php } else { ?>
							<img src="img/avatar.png" height="250px" width="250px">
						<?php } ?>
						
						<p>Change Avatar: <input type="file" name="avatar"></p>
					</div>
					<div class="col-lg-8 form-horizontal">
					<span style="font-size: 18px; font-weight: bold;">Personal Info</span><hr style="margin-top:1px;">
						<div class="form-group">
							<label class="col-sm-3 control-label">Username: </label>
							<div class="col-sm-5">
								 <input type="text" name="username" class="form-control" value="<?php echo $adminData['username']; ?>" readonly>
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">First Name: </label>
							<div class="col-sm-5">
								 <input type="text" name="fname" class="form-control" placeholder="Enter first name" value="<?php echo $adminData['fname']; ?>">
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Last Name: </label>
							<div class="col-sm-5">
								 <input type="text" name="lname" class="form-control" placeholder="Enter last name" value="<?php echo $adminData['lname']; ?>">
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email: </label>
							<div class="col-sm-5">
								 <input type="email" name="email" class="form-control" value="<?php echo $adminData['email']; ?>">
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"></label>
							<div class="col-sm-5">
								 <input type="submit" name="submit" class="btn btn-success" value="Save Changes">
							 </div>
						</div>
						</form>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <?php include_once 'inc/footer.php'; ?> 