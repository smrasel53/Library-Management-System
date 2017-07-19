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
			<span style="font-size: 20px; font-weight: bold;">View Book</span><span class="pull-right"><a href="booklist.php" class="btn btn-default btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></span><hr style="margin-top:3px;">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-eye" aria-hidden="true"></i> View Book</div>
        <?php 
            $query = "SELECT tbl_books.*, tbl_depts.dept_name FROM tbl_books LEFT JOIN tbl_depts ON tbl_books.dept_id = tbl_depts.dept_id WHERE book_id = '$book_id' ";
            $result = $db->select($query);
            if ($result) {
              while ($alldata = $result->fetch_assoc()) {
         ?>
				<div class="panel-body">
					<div class="col-lg-4">
            <?php if ($alldata['cover_book']) { ?>
              <img src="<?php echo $alldata['cover_book']; ?>" height="250px" width="250px">
            <?php } else { ?>
              <img src="img/books-icon.png" height="250px" width="250px">
            <?php } ?>
						<p style="font-size:25px;font-weight:bold;font-family:verdana;text-align: center;"><?php echo $alldata['book_name']; ?></p>
					</div>
					<div class="col-lg-8 form-horizontal">
					<span style="font-size: 18px; font-weight: bold;">Book Info</span><hr style="margin-top:1px;">
						<div class="form-group">
							<label class="col-sm-4 control-label">Department: </label>
							<div class="col-sm-4">
								 <?php echo $alldata['dept_name']; ?>
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Author: </label>
							<div class="col-sm-4">
								 <?php echo $alldata['author']; ?> 
							 </div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Shelf Location: </label>
							<div class="col-sm-4">
								 <?php echo $alldata['shelf']; ?> 
							 </div>
						</div>
					</div>
				</div>
        <?php } } ?>
			</div>
		</div>
	</div>
</div>
<?php include_once 'inc/footer.php'; ?>


