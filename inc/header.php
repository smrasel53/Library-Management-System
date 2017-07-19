<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/../database/Session.php');
  Session::init();
  include_once ($filepath.'/../database/DB.php');
  $db = new DB();

  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
        echo "<script>location='http://mindset-station.com/lms/login.php'</script>";
        exit();
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Library Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- DataTables CSS -->
    <link href="datatables/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="datatables/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/2639247f0f.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Library Management System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	  <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-modx" aria-hidden="true"></i> Modules <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="studentlist.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Student</a></li>
           <li><a href="addstudent.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Student</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="departmentlist.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Department</a></li>
           <li><a href="adddepartment.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Department</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="booklist.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Book</a></li>
           <li><a href="addbook.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Book</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="issuelist.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Issued Books</a></li>
           <li><a href="addissue.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Issue Book</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#">Link</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> <?php echo Session::get("username"); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
          <li><a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></i> Settings</a></li>
          <li><a href="changePwd.php"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></li>
            <li><a href="?action=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>