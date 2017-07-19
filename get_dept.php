<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
  $dept = $_GET['dept'];
 ?>

 <?php 
 	  $query = "SELECT * FROM tbl_books WHERE dept_id = '$dept' ";
	  $result = $db->select($query);
	  if ($result) {
	  	while ($book_data = $result->fetch_assoc()) {
  ?>
  <option value="<?php echo $book_data['book_id']; ?>"><?php echo $book_data['book_name']; ?></option>
  <?php } } else {?>
  	<option>Book Not Found!</option>
  <?php } ?>