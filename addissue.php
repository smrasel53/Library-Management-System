<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Issue Book</span><hr style="margin-top:1px;">
      <?php 
        if (isset($_POST['submit'])) {
          $errors = array();
          if (empty($_POST['stu_id'])) {
            $errors['stu_id'] = "Student name is required!";
          }
          if (empty($_POST['dept_id'])) {
            $errors['dept_id'] = "Select a department!";
          }
          if (empty($_POST['return_date'])) {
            $errors['return_date'] = "Return date is required!";
          }

          $stu_id = mysqli_real_escape_string($db->link, $_POST['stu_id']);
          $dept_id = mysqli_real_escape_string($db->link, $_POST['dept_id']);
          $book_id = mysqli_real_escape_string($db->link, $_POST['book_id']);
          $return_date = mysqli_real_escape_string($db->link, $_POST['return_date']);

          if (count($errors) == 0) {
              
              $query = "INSERT INTO tbl_issues(stu_id, dept_id, book_id, issue_date, return_date) VALUES ('$stu_id', '$dept_id', '$book_id', now(), '$return_date')";
              $inserted_rows = $db->insert($query);
              if ($inserted_rows) {
                $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Issued Successfully...</div>";
                echo "<script>location='http://mindset-station.com/lms/issuelist.php'</script>";
              } else {
                echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
              }
               
          }

        } 
       ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Issue Book</div>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post">
            <div class="form-group">
              <label for="stu_id" class="col-sm-2 col-sm-offset-1 control-label">Student Name: </label>
              <div class="col-sm-8">
                <select class="form-control" id="stu_id" name="stu_id">
                <option value="0" selected="true">--- Select One ---</option>
                <?php 
                  $query = "SELECT * FROM tbl_students ORDER BY name ASC";
                  $result = $db->select($query);
                  if ($result) {
                    while ($stu_data = $result->fetch_assoc()) {
                 ?>
                  <option value="<?php echo $stu_data['stu_id']; ?>"><?php echo $stu_data['name'].' - '.$stu_data['roll_no']; ?></option>
                  <?php } } ?>
                </select>
                <span class="error"><?php if (isset($errors['stu_id'])) { echo $errors['stu_id']; } ?></span>
               </div>
            </div>
						<div class="form-group">
							<label for="dept_id" class="col-sm-2 col-sm-offset-1 control-label">Department: </label>
							<div class="col-sm-8">
							 <select class="form-control" id="dept_list" onChange="getDept()" name="dept_id">
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
              <label for="book_id" class="col-sm-2 col-sm-offset-1 control-label">Book Name: </label>
              <div class="col-sm-8">
               <select class="form-control" id="book_list" name="book_id">
                  <option value="0" selected="true"></option>
                </select>
               </div>
            </div>
						<div class="form-group">
							<label for="return_date" class="col-sm-2 col-sm-offset-1 control-label">Return Date: </label>
							<div class="col-sm-8">
								<input type="date" name="return_date" id="return_date" class="form-control" value="<?php if (isset($_POST['return_date'])) { echo $_POST['return_date']; } ?>">
                <span class="error"><?php if (isset($errors['return_date'])) { echo $errors['return_date']; } ?></span>
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
<script>
  function getDept()
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "get_dept.php?dept="+document.getElementById("dept_list").value,false);
    xmlhttp.send(null);
    document.getElementById("book_list").innerHTML = xmlhttp.responseText;
  }
</script>
<?php include_once 'inc/footer.php'; ?>