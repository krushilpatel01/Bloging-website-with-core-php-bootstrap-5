<?php

  include("../config.php");
  session_start();

  if(isset($_SESSION['admin_name']) && $_SESSION['admin_email']){
  }
  else{
    header("location:admin_login.php");
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="admic.css">
    <title>Blogging Admin Side</title>
  </head>
  <body>

      <div class="row container-fluid p-0 m-0">
        <div class="col-2 sidebar">
          <div class="main-title">
            <h5 class="text-center">Admin Side</h5>
            <h1 class="admin-name" style="font-size:30px; text-align:center;">Welcome Demo</h1>
          </div>
          <div class="sidebar-menu">
            <ul class="navbar ps-2">
              <li class="navbar-item"><a href="index.php">Home</a></li>
              <li class="navbar-item"><a href="write_blog.php">Write Blog</a></li>
              <li class="navbar-item"><a href="login_detail.php">Login Detail</a></li>
              <li class="navbar-item"><a href="logout.php">Logout</a></li>
            </ul>
          </div>
          <div class="admin-footer">
            <span>Version 1.0.0 latest</span>
          </div>
        </div>
        <div class="col-10 mainbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
              <div class="navbar-nav mt-2">
                  <p><span><a href="home.php">Home</a></span> / <span><a href="page.php">Page</a></span></p>
                  <span></span>
              </div>
            </div>
          </div>
        </nav>
        <div class="white-bg">
          <img src="https://digitalrain.in/blog/images/article-submission-sites.jpg" alt="" srcset="">
        </div>
        </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>