<?php 
	$filepath = dirname(__FILE__);
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	if (isset($_GET['stu_id'])) {
		$stu_id = $_GET['stu_id'];
	}

	$queryImg  = "SELECT * FROM tbl_students WHERE stu_id='$stu_id'";
    $getImg = $db->select($queryImg);
    if ($getImg) {
    	while ($delimg = $getImg->fetch_assoc()) {
    		$dellink = $delimg['avatar'];
    		unlink($dellink);
    	}
    }
	$deleteQuery = "DELETE FROM tbl_students WHERE stu_id = '$stu_id'";
	$deleted_data = $db->delete($deleteQuery);
	if ($deleted_data) {
		$_SESSION['message'] = "<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Contact Deleted Successfully...</div>";
	    echo "<script>location='http://localhost/lms/studentlist.php'</script>";
	} 
 ?>
