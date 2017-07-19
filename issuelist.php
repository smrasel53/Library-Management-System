<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Manage Issue</span><hr style="margin-top:1px;">
      <div class="message">
          <?php 
              if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
          ?>
      </div>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-cog" aria-hidden="true"></i> Manage Issue</div>
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
                <th>Sl</th>
								<th>Name</th>
                <th>Roll No.</th>
                <th>Department</th>
                <th>Book Name</th>
                <th>Issue Date</th>
								<th>Return Date</th>
                <th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
            <?php 
                function formatDate($date)
                {
                  return date('j F, Y', strtotime($date));
                }

                $query = "SELECT tbl_issues.*, tbl_students.name, tbl_students.roll_no, tbl_depts.dept_name, tbl_books.book_name FROM tbl_issues INNER JOIN tbl_depts ON tbl_issues.dept_id = tbl_depts.dept_id INNER JOIN tbl_books ON tbl_issues.book_id = tbl_books.book_id INNER JOIN tbl_students ON tbl_students.stu_id = tbl_issues.stu_id ORDER BY issue_id DESC";
                $result = $db->select($query);
                if ($result) {
                  $i = 0;
                  while ($issue_data = $result->fetch_assoc()) {
                    $i++;
             ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
                <td><?php echo $issue_data['name']; ?></td>
                <td><?php echo $issue_data['roll_no']; ?></td>
                <td><?php echo $issue_data['dept_name']; ?></td>
								<td><?php echo $issue_data['book_name']; ?></td>
                <td><?php echo formatDate($issue_data['issue_date']); ?></td>
                <td><?php echo formatDate($issue_data['return_date']); ?></td>
                <td>
                    <?php 
                        $issue_date = formatDate($issue_data['issue_date']);
                        $return_date = formatDate($issue_data['return_date']);

                        $is_d = strtotime($issue_date);
                        $re_d = strtotime($return_date);

                        if ($is_d > $re_d) {
                          echo "<span class='label label-danger'>Delayed</span>";
                        } else {
                          echo "<span class='label label-success'>Issued</span>";
                        }
                     ?>
                </td>
								<td>
									<a href="deleteissue.php?issue_id=<?php echo $issue_data['issue_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Are you sure to delete this data?');"></i></a>
								</td>
							</tr>
              <?php  } }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
 <?php include_once 'inc/footer.php'; ?>