<?php   

include ("../config.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['admin_login'])){
        if(!empty($_POST['admin_email']) && !empty($_POST['admin_password'])){
            
            $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
            $password = mysqli_real_escape_string($conn, $_POST['admin_password']);

            // Fetch admin details based on email
            $sql = "SELECT * FROM user WHERE user_profile = 'admin' AND email = '$email'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                
                // Verify password (assuming it's hashed using password_hash)
                if(password_verify($password, $row['password'])){
                    $_SESSION['admin_name'] = $row['name'];  // Store admin name in session
                    $_SESSION['admin_email'] = $row['email'];
                    
                    echo "Admin login successful!";
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Incorrect password!";
                }
            } else {
                echo "You don't have admin access!";
            }
        } else {
            echo "Any field cannot be empty!";
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
    <title>Blogging Admin Side</title>
  </head>
  <body>

  <section class="admin_login">
        <form class="admin_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="form" style="color: white;">Admin Login</label>
            <input type="email" placeholder="Enter Amdin Email" name="admin_email">
            <input type="password" placeholder="Enter Amdin Password" name="admin_password">
            <input type="submit" value="Admin Login" name="admin_login">
            <span class="header_index" style="color:red"><a href="#">Go To User Side!</a></span>
        </form>
  </section>


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