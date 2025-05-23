<?php session_start(); ?>
<?php
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}
if (isset($_SESSION["type"])){
    if ($_SESSION["type"] == "admin") {
    header("location: ./admin.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payement</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/logout.css">

</head>
<body>
        <?php include "./php/header.php"; ?>
    <div style = "
                    display:flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 80vh;
                    font-size:60px;
    ">

    <?php if (isset($_SESSION["user"])) {
        echo "Welcome " . $_SESSION["user"];
    };?>


    <form action="" method="POST" class="logout">
      <button type="submit" name="submit">
        <img src="./img/logout.png" alt="Logout" />
    </button>
    </form>
    <?php
  if (isset($_POST['submit'])) {
    session_unset();
    session_destroy();
    header("location: ./");
    exit();
  }
?>
</body>
</html>