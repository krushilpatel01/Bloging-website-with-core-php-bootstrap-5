<?php
include ("../config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['blog_upload'])){
        // $titleerr = $descerr = $categorieserr = $tags = "";

        if(!empty($_POST['blog_title'])){
            $blog_title = htmlspecialchars($_POST['blog_title']);
        } else {
            echo "<script>alert('title cant be empty'); Window.history.back();</script>";
            exit;
        }

        $blog_desc = htmlspecialchars($_POST['blog_desc']);
        $categories = htmlspecialchars($_POST['categories']);
        $tags = htmlspecialchars($_POST['tags']);

        // Prevent duplicate insert by checking if the title already exists
        $check_sql = "SELECT * FROM write_blog WHERE blog_title = '$blog_title'";
        $check_result = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($check_result) > 0) {
            echo "This blog title already exists!";
        } else {
            $sql = "INSERT INTO write_blog (blog_title, blog_desc, blog_cate, blog_tags)
                    VALUES ('$blog_title', '$blog_desc', '$categories', '$tags')";
            $result = mysqli_query($conn, $sql);

            if($result){
                mysqli_close($conn);
                // Redirect to prevent duplicate insertion on refresh
                header("Location: write_blog.php?success=1");
                exit;
            } else {
                echo "Failed to upload";
            }
        }
    }
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
    <title>Write Blog Here</title>
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
              <li class="navbar-item"><a href="#">Logout</a></li>
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
                  <p><span><a href="home.php">Home</a></span> / <span><a href="write_blog.php">Write Blog</a></span></p>
                  <span></span>
              </div>
            </div>
          </div>
        </nav>

        <div class="blog-section">
            <div class="row">
                <div class="col-12 blog-input-box">
                    <h2>You Can Describe Your Blog Here!</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <input type="text" name="blog_title" id="" placeholder="Enter Your Blog Title Here">
                        <br>
                        <textarea name="blog_desc" id="" rows="5" placeholder="Enter Blog Desc"></textarea>
                        <br>
                        <input type="text" name="categories" placeholder="Enter Your Blog Categories" id="">
                        <br>
                        <input type="text" name="tags" id="" placeholder="Enter Your Tags">
                        <br>
                        <input type="submit" value="Upload Blog" name="blog_upload">
                    </form>
                </div>
            </div>
          
            <div class="row mt-4">
                <div class="col- all-blog-list">
                <?php
                  include ("../config.php");

                  // Fetch all blog posts
                  $sql = "SELECT * FROM write_blog ORDER BY id DESC"; 
                  $result = mysqli_query($conn, $sql);
                  ?>

                  <table class="table table-bordered">
                      <thead class="table-dark">
                          <tr>
                              <th>Sr No.</th>
                              <th>Blog Title</th>
                              <th>Blog Categories</th>
                              <th>Blog Tags</th>
                              <th>Blog Description</th>
                              <th>Blog Time</th>
                              <th>Blog Writer</th>
                              <th>Blog Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          if (mysqli_num_rows($result) > 0) {
                              $sr_no = 1;
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>";
                                  echo "<td>" . $sr_no++ . "</td>";
                                  echo "<td>" . htmlspecialchars($row['blog_title']) . "</td>";
                                  echo "<td>" . htmlspecialchars($row['blog_cate']) . "</td>";
                              
                                  // Handling multiple tags
                                  $tags = explode(",", $row['blog_tags']);
                                  echo "<td>";
                                  foreach ($tags as $tag) {
                                      echo "<span class='badge bg-primary me-1'>" . htmlspecialchars(trim($tag)) . "</span>";
                                  }
                                  echo "</td>";
                                
                                  echo "<td>" . nl2br(htmlspecialchars($row['blog_desc'])) . "</td>";
                                
                                  // Fix: Handle missing created_at column
                                  $created_at = !empty($row['created_at']) ? date("d M Y h:i A", strtotime($row['created_at'])) : "N/A";
                                  echo "<td>" . $created_at . "</td>";
                                
                                  echo "</tr>";
                              }
                          } else {
                              echo "<tr><td colspan='6' class='text-center'>No blogs found.</td></tr>";
                          }
                          ?>
                      </tbody>
                  </table>
                        
<?php mysqli_close($conn); ?>
          
                    </div>
            </div>
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