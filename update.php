<?php
include 'db.php';

$serialNumber = $_POST['Serial_Number'];
$username = $_POST['username'];
$email = $_POST['email'];

$sql = "UPDATE users SET username=?, email=? WHERE Serial_Number=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $username, $email, $serialNumber);

if ($stmt->execute()) {
    echo "User updated successfully!";
} else {
    echo "Error updating user.";
}

$stmt->close();
$conn->close();
?>
