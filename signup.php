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

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <button type="submit">Sign Up</button>
</form>
