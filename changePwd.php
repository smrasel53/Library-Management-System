<?php 
	$filepath = dirname(__FILE__);
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	$adminId = Session::get("adminId");
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Change Password</span><hr style="margin-top:1px;">
			<?php 
				if (isset($_POST['submit'])) {
					$oldPwd = mysqli_real_escape_string($db->link, md5($_POST['oldPwd']));
					$newPwd = mysqli_real_escape_string($db->link, md5($_POST['newPwd']));
					$confirmNewPwd = mysqli_real_escape_string($db->link, md5($_POST['confirmNewPwd']));

					if ($newPwd != $confirmNewPwd){
						echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password doesn't matched!</div>";
					} else {
						$query = "SELECT adminId FROM tbl_admin WHERE password = '$oldPwd'";
						$result = $db->select($query);
						if ($result != false) {
							$passQuery = "UPDATE tbl_admin SET password = '$newPwd' WHERE adminId = '$adminId'";
							$changePwd_data = $db->update($passQuery);
							if ($changePwd_data) {
								echo "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Changed Successfully...</div>";
							}
						} else {
							echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Old password not matched!</div>";
						}
					}
				}
			 ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Password</div>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post">
						<div class="form-group">
							<label for="oldPwd" class="col-sm-2 col-sm-offset-1 control-label">Old Password: </label>
							<div class="col-sm-8">
								<input type="text" name="oldPwd" id="oldPwd" class="form-control" placeholder="Enter old password" required>
							 </div>
						</div>
						<div class="form-group">
							<label for="newPwd" class="col-sm-2 col-sm-offset-1 control-label">New Password: </label>
							<div class="col-sm-8">
								<input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="Enter new password" required>
							 </div>
						</div>
						<div class="form-group">
							<label for="confirmNewPwd" class="col-sm-2 col-sm-offset-1 control-label">Confirm New Password: </label>
							<div class="col-sm-8">
								<input type="password" name="confirmNewPwd" id="confirmNewPwd" class="form-control" placeholder="Enter confirm new password" required>
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-offset-1 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" name="submit" class="btn btn-success">Change Password</button>
							 </div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>