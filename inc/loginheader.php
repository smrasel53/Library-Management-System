<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/../database/Session.php');
  Session::init();
  include_once ($filepath.'/../database/DB.php');
  $db = new DB();
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Library Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login-style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/2639247f0f.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
      <h1 class="text-center" style="font-size: 28px;margin-top: 10px;font-weight: bold;">Library Management System</h1>
  </div><!-- /.container-fluid -->
</nav>