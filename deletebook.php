<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
  }

  $queryImg  = "SELECT * FROM tbl_books WHERE book_id='$book_id'";
    $getImg = $db->select($queryImg);
    if ($getImg) {
      while ($delimg = $getImg->fetch_assoc()) {
        $dellink = $delimg['cover_book'];
        unlink($dellink);
      }
    }
  $query = "DELETE FROM tbl_books WHERE book_id = '$book_id' ";
  $deleted_row = $db->delete($query);
  if ($deleted_row) {
  	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Book Deleted Successfully...</div>";
    echo "<script>location='http://localhost/lms/booklist.php'</script>";
  } else {
  	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
  }
 ?>