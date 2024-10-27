<?php
include 'db.php';

$serialNumber = $_POST['Serial_Number'];

$sql = "DELETE FROM users WHERE Serial_Number=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $serialNumber);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error deleting user.";
}

$stmt->close();
$conn->close();
?>
