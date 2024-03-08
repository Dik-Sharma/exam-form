<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <ul>
        <li><a href="form-fill.php">Apply</a></li>
        <li><a href="logout.php">SIGN-OUT</a></li>
    </ul>
</body>

</html>