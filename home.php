<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['Serial_Number'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';


$sql = "SELECT Serial_Number, username, email, Date FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <h2>Welcome to the Dashboard</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Sign-Up Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr data-id="<?php echo $row['Serial_Number']; ?>">
            <td contenteditable="true"><?php echo $row['username']; ?></td>
            <td contenteditable="true"><?php echo $row['email']; ?></td>
            <td><?php echo $row['Date']; ?></td>
            <td>
                <button onclick="updateUser(<?php echo $row['Serial_Number']; ?>)">Update</button>
                <button onclick="deleteUser(<?php echo $row['Serial_Number']; ?>)">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <script>
        function updateUser(serialNumber) {
            const row = document.querySelector(`tr[data-id='${serialNumber}']`);
            const username = row.children[0].innerText;
            const email = row.children[1].innerText;

            $.post("update.php", { Serial_Number: serialNumber, username: username, email: email }, function(response) {
                alert(response);
            });
        }

        function deleteUser(serialNumber) {
            if (confirm("Are you sure you want to delete this user?")) {
                $.post("delete.php", { Serial_Number: serialNumber }, function(response) {
                    if (response === "Success") {
                        $(`tr[data-id='${serialNumber}']`).remove();
                    } else {
                        alert("Failed to delete user.");
                    }
                });
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
