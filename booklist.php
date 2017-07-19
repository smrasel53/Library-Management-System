<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Manage Book</span><hr style="margin-top:1px;">
      <div class="message">
          <?php 
              if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
          ?>
      </div>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-cog" aria-hidden="true"></i> Manage Book</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
                <th>Sl</th>
								<th>Book Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
              <?php 
                  $query = "SELECT tbl_books.*, tbl_depts.dept_name FROM tbl_books LEFT JOIN tbl_depts ON tbl_books.dept_id = tbl_depts.dept_id ORDER BY book_id DESC ";
                  $result = $db->select($query);
                  if ($result) {
                    while ($book_data = $result->fetch_assoc()) {
               ?>
							<tr class="odd gradeX">
								<td>
                  <?php if ($book_data['cover_book']) { ?>
                    <img src="<?php echo $book_data['cover_book']; ?>" height="30px" width="30px">
                  <?php } else { ?>
                    <img src="img/books-icon.png" height="30px" width="30px">
                  <?php } ?>
                </td>
								<td><?php echo $book_data['book_name']; ?></td>
								<td>
                  <a href="viewbook.php?book_id=<?php echo $book_data['book_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="editbook.php?book_id=<?php echo $book_data['book_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<a href="deletebook.php?book_id=<?php echo $book_data['book_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data?'); "><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
             <?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
 <?php include_once 'inc/footer.php'; ?>
