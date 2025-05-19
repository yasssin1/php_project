<?php session_start(); ?>
<?php
if (isset($_SESSION["type"])){
    if ($_SESSION["type"] == "admin") {
    header("location: ./admin.php");
    exit();
} else {
    header("location: ./profile.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <form method="post">
        <label for = "name">login:</label><input type="text" placeholder="name" name = "name" id = "name" required>
        <label for = "email">email:</label><input type="text" placeholder="email" name = "email" id = "email" required>
        <label for = "password">password:</label><input type="password" placeholder="password" name = "password" id = "password" required><br>
        <input type="submit">
    </form><br>
    <a href = "login.php">login?</a>
    <?php
        include "./php/submit.php";

        if (isset($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
            $pass = $_POST["password"];
            $email = htmlspecialchars($_POST['email']);
            if(submit_account($name, $pass, $email)) {
                header("location: login.php");
                exit;
            } else {
                echo "<p style='color: red;'>account not created!</p>";
            }
        }
    ?>
</body>
</html>