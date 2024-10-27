<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    
    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long, include at least one number and one special character.');</script>";
    } 
    
    else {
        $emailCheckSql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($emailCheckSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $emailResult = $stmt->get_result();

        
        $usernameCheckSql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($usernameCheckSql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $usernameResult = $stmt->get_result();

        
        if ($emailResult->num_rows > 0) {
            echo "<script>alert('Email already exists. Please use a different email.');</script>";
        } 
        
        else if ($usernameResult->num_rows > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        } 
        
        else {
            if ($password === $confirmPassword) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashedPassword);

                if ($stmt->execute()) {
                    echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "<script>alert('Passwords do not match.');</script>";
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!-- signup.php -->
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if username and email already exist
    $checkSql = "SELECT * FROM users WHERE username=? OR email=?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username or Email already exists.');</script>";
    } elseif ($password === $confirmPassword) {
        if (strlen($password) >= 8 && preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[\W_]/', $password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>alert('Password must be at least 8 characters long and include a symbol and a number.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }

    $checkStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        body {
            background-color: #eee;
        }
        .card {
            border-radius: 25px;
        }
        .form-outline {
            margin-bottom: 15px;
        }
        .form-check {
            margin-bottom: 20px;
        }
        .form-check-input {
            margin-top: 0.3em;
        }
        .login-prompt {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <script src="script.js"></script>
</head>
<body>
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" method="POST" action="">
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="username" id="username" placeholder="Your Name" required />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="email" placeholder="Your Email" required />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="password" id="password" placeholder="Password" required />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password" required />
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-start mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="terms" required />
                    <label class="form-check-label" for="terms">
                      I agree to all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>
               
                <div class="login-prompt">
                  <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="./images/signup.webp" class="img-fluid" alt="Sign Up Image"> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>


<!-- <form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <button type="submit">Sign Up</button>
</form> -->
