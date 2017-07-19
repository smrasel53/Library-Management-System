<?php 
  $filepath = dirname(__FILE__);
  include_once ($filepath.'/inc/loginheader.php');
  Session::checkLogin();
 ?>
<div class="container">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
      <form class="sign-up" method="post">
        <h1 class="sign-up-title">Admin Login</h1>
        <input type="text" name="username" class="sign-up-input" placeholder="Username" autofocus>
        <input type="password" name="password" class="sign-up-input" placeholder="Password">
        <input type="submit" name="submit" value="Login" class="sign-up-button">
        <br/><br/>
        <?php 
          if (isset($_POST['submit'])) {
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $password = mysqli_real_escape_string($db->link, md5($_POST['password']));

            if ($username == "" || $password == "") {
              echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Field must not be empty!</div>";
            } else {
              $query = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
              $result = $db->select($query);
              if ($result != false) {
                $value = $result->fetch_assoc();
                  Session::init();
                  Session::set("login", true);
                  Session::set("username", $value['username']);
                  Session::set("adminId", $value['adminId']);
                  echo "<script>location='http://mindset-station.com/lms/'</script>";
                
              } else {
                echo "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username or Password Not Matched!</div>";
              }
            }
          }
         ?> 
      </form>
    </div>
  </div>
</div>
 <footer class="navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid text-center">
      <h4 style="color: #fff;font-size: 20px;padding: 10px;">Copyright &copy; Library Management System. All Rights Revered.</h4>
    </div>
 </footer>
</body>
</html>
