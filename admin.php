<?php session_start(); ?>
<?php if ($_SESSION["type"] != "admin") {
    header("location: ./");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="./css/formTabs.css">
    <link rel="stylesheet" href="./css/logout.css">
</head>
<body>
    <div class = "main">
    <div class = "form-pane">
        <div class = "form-tabs">
            <button class = "form-name" onclick="showTab(event, 'Add')">Add</button>
            <button class = "form-name" onclick="showTab(event, 'Edit')">Edit</button>
            <button class = "form-name" onclick="showTab(event, 'Delete')">Delete</button>
        </div>
        <form id="Add" class="tab-content" method="post"><div class = "form-items">
            <label for="prodID">product id:</label><input type = "text" required>
            <label for="prodName">product name:</label><input type = "text" required>
        </div>
            <input type="submit" value="Add">
        </form>
        <form id="Edit" class="tab-content" method="post"><div class = "form-items">
            <label for="prodID">product id:</label><input type = "text" required>
            <label for="prodName">new product name:</label><input type = "text" required>
        </div>
            <input type="submit" value="Edit">
        </form>
        <form id="Delete" class="tab-content" method="post"><div class = "form-items">
            <label for="prodID">product id:</label><input type = "text" required>
        </div>
            <input type="submit" value="Delete">
        </form>
    </div>
    </div>
    <form action="" method="POST" class="logout">
      <button type="submit" name="submit">
        <img src="./img/logout.png" alt="Logout" />
    </button>
    </form>
    <script>
function showTab(event, id) {
  var i, tabList, tablinks;
  tabList = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabList.length; i++) {
    tabList[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("form-name");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className= "form-name";
  }
  document.getElementById(id).style.display = "block";
  event.currentTarget.className += " active";
}
document.addEventListener("DOMContentLoaded", function () {
  document.querySelector(".form-name").click();
});
</script>
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
