<?php
// Connect to your database
$conn = new mysqli("localhost", "root", "", "gym"); // change if needed

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $id = $_POST['user_id'];
    $result = $conn->query("SELECT * FROM gym_user WHERE id = '$id'");
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];

    $update = "UPDATE gym_user SET 
                fname = '$fname',
                lname = '$lname',
                phone = '$phone',
                email = '$email',
                address = '$address',
                dob = '$dob'
              WHERE id = '$id'";

    if ($conn->query($update)) {
        echo " User information updated successfully!";
    } else {
        echo " Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h1>Edit User Info</h1>
<form method="post">
    <label>Enter User ID:</label>
    <input type="text" name="user_id" required />
    <button type="submit" name="search">Search</button>
</form>

<?php if (isset($user)): ?>
    <form method="post">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>"/>

        <p>First Name: <input type="text" name="fname" value="<?= $user['fname'] ?>"></p>
        <p>Last Name: <input type="text" name="lname" value="<?= $user['lname'] ?>"></p>
        <p>Phone Number: <input type="text" name="phone" value="<?= $user['phone'] ?>"></p>
        <p>Email: <input type="email" name="email" value="<?= $user['email'] ?>"></p>
        <p>Address: <input type="text" name="address" value="<?= $user['address'] ?>"></p>
        <p>Date of Birth: <input type="date" name="dob" value="<?= $user['dob'] ?>"></p>

        <button type="submit" name="update">Update</button>
    </form>
<?php endif; ?>

</body>
</html>
