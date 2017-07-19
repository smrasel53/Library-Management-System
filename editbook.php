<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
  }
 ?>
<div class="container">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
      <span style="font-size: 20px; font-weight: bold;">Edit Book</span><hr style="margin-top:1px;">
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
                  $queryImg  = "SELECT * FROM tbl_books WHERE book_id='$book_id'";
                    $getImg = $db->select($queryImg);
                    if ($getImg) {
                      while ($delimg = $getImg->fetch_assoc()) {
                        $dellink = $delimg['cover_book'];
                        unlink($dellink);
                      }
                    }
                  move_uploaded_file($file_temp, $uploaded_image);
                  $query = "UPDATE tbl_books 
                            SET book_name = '$book_name',
                              dept_id = '$dept_id',
                              author = '$author',
                              shelf = '$shelf',
                              cover_book = '$uploaded_image' 
                              WHERE book_id = '$book_id'";
                  $updated_rows = $db->update($query);
                  if ($updated_rows) {
                    $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Updated Successfully...</div>";
                    echo "<script>location='http://mindset-station.com/lms/booklist.php'</script>";
                  } else {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
                  }
                }
              } else {
                 $query = "UPDATE tbl_books 
                          SET book_name = '$book_name',
                            dept_id = '$dept_id',
                            author = '$author',
                            shelf = '$shelf' 
                            WHERE book_id = '$book_id'";
                  $updated_rows = $db->update($query);
                  if ($updated_rows) {
                    $_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Updated Successfully...</div>";
                    echo "<script>location='http://mindset-station.com/lms/booklist.php'</script>";
                  } else {
                    echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
                  }
              } 
          }
        } 
       ?>
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Book</div>
        <?php 
          $query = "SELECT * FROM tbl_books WHERE book_id = '$book_id'";
          $result = $db->select($query);
          if ($result) {
            while ($book_data = $result->fetch_assoc()) {
         ?>
        <div class="panel-body">
          <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="book_name" class="col-sm-2 col-sm-offset-1 control-label">Book Name: </label>
              <div class="col-sm-8">
                <input type="text" name="book_name" id="book_name" class="form-control" placeholder="Please enter book name" value="<?php echo $book_data['book_name']; ?>">
                <span class="error"><?php if (isset($errors['book_name'])) { echo $errors['book_name']; } ?></span>
               </div>
            </div>
            <div class="form-group">
              <label for="department" class="col-sm-2 col-sm-offset-1 control-label">Department: </label>
              <div class="col-sm-8">
               <select class="form-control" id="dept_id" name="dept_id">
                <option value="0" disabled="true" selected="true">--- Select One ---</option>
                <?php 
                  $query = "SELECT * FROM tbl_depts";
                  $result = $db->select($query);
                  if ($result) {
                    while ($dept_data = $result->fetch_assoc()) {
                 ?>
                  <option <?php if ($book_data['dept_id'] == $dept_data['dept_id']) { ?>
                            selected="selected"
                            <?php } ?>
                            value="<?php echo $dept_data['dept_id'] ?>"><?php echo $dept_data['dept_name']; ?></option>
                  <?php } } ?>
                </select>
                <span class="error"><?php if (isset($errors['dept_id'])) { echo $errors['dept_id']; } ?></span>
               </div>
            </div>
            <div class="form-group">
              <label for="author" class="col-sm-2 col-sm-offset-1 control-label">Author: </label>
              <div class="col-sm-8">
                <input type="text" name="author" id="author" class="form-control" placeholder="Please enter author name" value="<?php echo $book_data['author']; ?>">
                <span class="error"><?php if (isset($errors['author'])) { echo $errors['author']; } ?></span>
               </div>
            </div>
            <div class="form-group">
              <label for="shelf" class="col-sm-2 col-sm-offset-1 control-label">Shelf Location: </label>
              <div class="col-sm-8">
                <input type="text" name="shelf" id="shelf" class="form-control" placeholder="Please enter shelf location" value="<?php echo $book_data['shelf']; ?>">
                <span class="error"><?php if (isset($errors['shelf'])) { echo $errors['shelf']; } ?></span>
               </div>
            </div>
            <div class="form-group">
              <label for="shelf" class="col-sm-2 col-sm-offset-1 control-label">Book Cover: </label>
              <div class="col-sm-8">
                <?php if ($book_data['cover_book']) { ?>
                    <img src="<?php echo $book_data['cover_book']; ?>" height="250px" width="250px" style="margin-bottom: 5px;">
                <?php } else { ?>
                    <img src="img/books-icon.png" height="250px" width="250px" style="margin-bottom: 5px;">
                <?php } ?>
                <input type="file" name="cover_book">
               </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-offset-1 control-label"></label>
              <div class="col-sm-8">
                <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                <a href="booklist.php" class="btn btn-default">Cancel</a>
               </div>
            </div>
          </form>
        </div>
        <?php } } ?>
      </div>
    </div>
  </div>
</div>
 <?php include_once 'inc/footer.php'; ?>>
