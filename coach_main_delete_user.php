<?php
// Connect to your database
$conn = new mysqli("localhost", "root", "", "gym"); // change if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];

    // Confirm user exists before deleting
    $check = $conn->query("SELECT * FROM gym_user WHERE id = '$id'");
    
    if ($check->num_rows > 0) {
        $delete = $conn->query("DELETE FROM gym_user WHERE id = '$id'");
        if ($delete) {
            $msg = "User with ID $id deleted successfully.";
        } else {
            $msg = " Error deleting user: " . $conn->error;
        }
    } else {
        $msg = "⚠️ No user found with ID $id.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        html{ color-scheme: dark;
        }
      *{text-align: center;}

    </style>
    <title>Delete User</title>
</head>
<body>

<h1>Delete User</h1>

<form method="post">
    <label>Enter User ID:</label>
    <input type="text" name="user_id" required />
    <button type="submit">Delete</button>
</form>

<?php if (isset($msg)): ?>
    <p style="margin-top: 20px;"><?= $msg ?></p>
<?php endif; ?>


</body>
</html>
