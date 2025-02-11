<?php
include ("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);

        // Check if email format is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit; // Stop further processing
        }

        // Escape the email to prevent SQL injection
        $email = mysqli_real_escape_string($conn, $email);

        // Check if email already exists
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result1 = mysqli_query($conn, $query);

        if (mysqli_num_rows($result1) > 0) {
            echo "This email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user into the database
            $sql = "INSERT INTO user (name, email, password, user_role) 
                    VALUES ('$name', '$email', '$hashed_password', '$role')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Registration successful!";
                header("location:login.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "All fields are required to be filled.";
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
      <link rel="stylesheet" href="blog.css">
      <title>Blog Website</title>
    </head>
  <body>
<section class="main-form">
  <div class="container">
    <div class="row">
      <div class="col-4 form-box">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <h1 class="h3 mb-3 fw-normal text-center">Enter Your Details</h1>

          <input type="text" name="name" placeholder="Enter your Full Name" id="">
          <input type="email" name="email" placeholder="Enter Your Email" id="">
          <input type="password" name="password" placeholder="Enter Your Password" id="">
          <select id="" name="role" Required>
                <option value="" disabled selcted>Choose Role</option>
                <option value="Graphic">Graphic Designer</option>
                <option value="Web Designer">WEb Designer</option>
                <option value="Digital Marketer">DIgital Marketing</option>
          </select>
          <input class="w-100 btn btn-lg btn-primary mb-2" type="submit" name="submit" value="Sign-in">
        </form>
        <div class="extra-section">
          <a href="login.php">I Have an Account! </a>
        </div>
        </div>
      </div>
    </div>
    </section>
  </main>    
  </body>
</html>
