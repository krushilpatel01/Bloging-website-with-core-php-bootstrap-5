<?php
session_start(); // Start the session to manage sessions


include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $email = mysqli_real_escape_string($conn, $email);

        // Query to get user details based on email
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify password with hashed password in the database
            if (password_verify($password, $user['password'])) {
                // Successful login, set session variables
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['user_role']; 

                // Redirect to home page
                header("Location: index.php");
                exit(); // Always call exit after header redirect
            } else {
                // Incorrect password
                echo "Invalid password!";
            }
        } else {
            // Email not found
            echo "No user found with this email!";
        }
    } else {
        // Missing email or password
        echo "Please enter both email and password!";
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
          <h1 class="h3 mb-5 fw-normal text-center">Login Now</h1>

          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
          </div>
          <br>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me">Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">Sign in</button>
          <a href="#">Forgot Password!</a>
        </form>
        <div class="extra-section">
          <a href="signup.php">You Have No Account? Sign Up Here!</a>
        </div>
        </div>
      </div>
    </div>
    </section>
  </main>    
  </body>
</html>
