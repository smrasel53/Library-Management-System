<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/header.php');
  Session::checkSession();
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span style="font-size: 20px; font-weight: bold;">Dashboard</span><hr style="margin-top:1px;">
			<div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</div>
				<div class="panel-body">
					<div class="row" >
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Students
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php 
                                        $query = "SELECT * FROM tbl_students";
                                        $result = $db->select($query);
                                        if ($result) {
                                          $total = $result->num_rows;
                                          echo $total;
                                        } else {
                                          echo "0";
                                        }
                                     ?>
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-book fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Total Books
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php 
                                        $query = "SELECT * FROM tbl_books";
                                        $result = $db->select($query);
                                        if ($result) {
                                          $total = $result->num_rows;
                                          echo $total;
                                        } else {
                                          echo "0";
                                        }
                                     ?>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-puzzle-piece fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Departments
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php 
                                        $query = "SELECT * FROM tbl_depts";
                                        $result = $db->select($query);
                                        if ($result) {
                                          $total = $result->num_rows;
                                          echo $total;
                                        } else {
                                          echo "0";
                                        }
                                     ?>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-tasks fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Issued Books
                                </div>
                                <div class="circle-tile-number text-faded">
                                      <?php 
                                        $query = "SELECT * FROM tbl_issues";
                                        $result = $db->select($query);
                                        if ($result) {
                                          $total = $result->num_rows;
                                          echo $total;
                                        } else {
                                          echo "0";
                                        }
                                     ?>
                                    <span id="sparklineB"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-ban fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Mentions
                                </div>
                                <div class="circle-tile-number text-faded">
                                    30
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-comments fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Mentions
                                </div>
                                <div class="circle-tile-number text-faded">
                                    96
                                    <span id="sparklineD"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once 'inc/footer.php'; ?>
