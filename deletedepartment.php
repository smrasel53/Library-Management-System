<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  if (isset($_GET['dept_id'])) {
    $dept_id = $_GET['dept_id'];
  }
  $query = "DELETE FROM tbl_depts WHERE dept_id = '$dept_id' ";
  $deleted_row = $db->delete($query);
  if ($deleted_row) {
  	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Department Deleted Successfully...</div>";
    echo "<script>location='http://localhost/lms/departmentlist.php'</script>";
  } else {
  	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
  }
 ?>