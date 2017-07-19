<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Add Book</span><hr style="margin-top:1px;">
      <?php 
        if (isset($_POST['submit'])) {
          $errors = array();
          if (empty($_POST['book_name'])) {
            $errors['book_name'] = "Book name is required!";
          }
          if (empty($_POST['dept_id'])) {
            $errors['dept_id'] = "Select a department!";
          } 
          if (empty($_POST['author'])) {
            $errors['author'] = "Author is required!";
          }
          if (empty($_POST['shelf'])) {
            $errors['shelf'] = "Shelf location is required!";
          }

          $book_name = mysqli_real_escape_string($db->link, $_POST['book_name']);
          $dept_id = mysqli_real_escape_string($db->link, $_POST['dept_id']);
          $author = mysqli_real_escape_string($db->link, $_POST['author']);
          $shelf = mysqli_real_escape_string($db->link, $_POST['shelf']);

          $permited  = array('jpg', 'jpeg', 'png', 'gif');
          $file_name = $_FILES['cover_book']['name'];
          $file_size = $_FILES['cover_book']['size'];
          $file_temp = $_FILES['cover_book']['tmp_name'];
         
          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "uploads/books/".$unique_image;


          if (count($errors) == 0) {
              if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Image size should be less than 1MB!</div>";
                } else if (in_array($file_ext, $permited) === false) {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can upload only:- ".implode(', ', $permited)."!</div>";
                } else {
                  move_uploaded_file($file_temp, $uploaded_image);
                  $query = "INSERT INTO tbl_books(book_name, dept_id, author, shelf, cover_book) VALUES ('$book_name', '$dept_id', '$author', '$shelf', '$uploaded_image')";
                  $inserted_rows = $db->insert($query);
                  if ($inserted_rows) {
                    $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Added Successfully...</div>";
                    echo "<script>location='http://mindset-station.com/lms/booklist.php'</script>";
                  } else {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
                  }
                }
              } else {
                $query = "INSERT INTO tbl_books(book_name, dept_id, author, shelf) VALUES ('$book_name', '$dept_id', '$author', '$shelf')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                  $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Added Successfully...</div>";
                  echo "<script>location='http://mindset-station.com/lms/booklist.php'</script>";
                } else {
                  echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
                }
              } 
          }

        } 
       ?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Book</div>
				<div class="panel-body">
					<form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="book_name" class="col-sm-2 col-sm-offset-1 control-label">Book Name: </label>
							<div class="col-sm-8">
								<input type="text" name="book_name" id="book_name" class="form-control" placeholder="Please enter book name" value="<?php if (isset($_POST['book_name'])) { echo $_POST['book_name']; } ?>">
                <span class="error"><?php if (isset($errors['book_name'])) { echo $errors['book_name']; } ?></span>
							 </div>
						</div>
						<div class="form-group">
							<label for="department" class="col-sm-2 col-sm-offset-1 control-label">Department: </label>
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
							<label for="author" class="col-sm-2 col-sm-offset-1 control-label">Author: </label>
							<div class="col-sm-8">
								<input type="text" name="author" id="author" class="form-control" placeholder="Please enter author name" value="<?php if (isset($_POST['author'])) { echo $_POST['author']; } ?>">
                <span class="error"><?php if (isset($errors['author'])) { echo $errors['author']; } ?></span>
							 </div>
						</div>
            <div class="form-group">
              <label for="shelf" class="col-sm-2 col-sm-offset-1 control-label">Shelf Location: </label>
              <div class="col-sm-8">
                <input type="text" name="shelf" id="shelf" class="form-control" placeholder="Please enter shelf location" value="<?php if (isset($_POST['shelf'])) { echo $_POST['shelf']; } ?>">
                <span class="error"><?php if (isset($errors['shelf'])) { echo $errors['shelf']; } ?></span>
               </div>
            </div>
            <div class="form-group">
              <label for="shelf" class="col-sm-2 col-sm-offset-1 control-label">Cover Book: </label>
              <div class="col-sm-8">
                <input type="file" name="cover_book" class="form-control">
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
 <?php include_once 'inc/footer.php'; ?>>
