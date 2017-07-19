<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  if (isset($_GET['issue_id'])) {
    $issue_id = $_GET['issue_id'];
  }
  $query = "DELETE FROM tbl_issues WHERE issue_id = '$issue_id' ";
  $deleted_row = $db->delete($query);
  if ($deleted_row) {
  	$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Issued Deleted Successfully...</div>";
    echo "<script>location='http://localhost/lms/issuelist.php'</script>";
  } else {
  	echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops ! Something went wrong.</div>";
  }
 ?>