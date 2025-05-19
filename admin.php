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
    <link rel="stylesheet" href="./css/alert.css">
</head>
<body>
    <div class = "main">
    <div class = "form-pane">
        <div class = "form-tabs">
            <button class = "form-name" onclick="showTab(event, 'Add')">Add</button>
            <button class = "form-name" onclick="showTab(event, 'Edit')">Edit</button>
            <button class = "form-name" onclick="showTab(event, 'Delete')">Delete</button>
        </div>
        <!-- ADD FORM -->
        <form id="Add" class="tab-content" method="post" enctype="multipart/form-data"><div class = "form-items">
            <input type = "hidden" id = "add">
            <label for="prodName">product name:</label><input type = "text" name = "prodName" id = "prodName" required>
            <label for="description">product description:</label><textarea name="description" id="description" required></textarea>
            <label for="prodImage">product image:</label><input type = "file" name = "prodImage" id = "prodImage">
            <label for="prodPrice">product price:</label><input type = "number" name = "prodPrice" id = "prodPrice" required>
            <label for="prodCat">product category:</label><input type = "text" name = "prodCat" id = "prodCat" required>
            <label for="prodBrand">product brand:</label><input type = "text" name = "prodBrand" id = "prodBrand" required>
        </div>
            <input type="submit" value="Add">
        </form>
        <!-- EDIT FORM -->
        <form id="Edit" class="tab-content" method="post" enctype="multipart/form-data"><div class = "form-items">
          <input type = "hidden" id = "edit">
            <label for="editID">product id:</label><input type = "number" name = "editID" id = "editID" required>
            <label for="editName">product name:</label><input type = "text" name = "editName" id = "editName" required>
            <label for="editdescription">product description:</label><textarea name="editdescription" id="editdescription" required></textarea>
            <label for="editImage">product image:</label><input type = "file" name = "editImage" id = "editImage">
            <label for="editPrice">product price:</label><input type = "number" name = "editPrice" id = "editPrice" required>
            <label for="editCat">product category:</label><input type = "text" name = "editCat" id = "editCat" required>
            <label for="editBrand">product brand:</label><input type = "text" name = "editBrand" id = "editBrand" required>
        </div>
            <input type="submit" value="Edit">
        </form>
        <!-- DELETE FORM -->
         <input type = "hidden" id = "delete">
        <form id="Delete" class="tab-content" method="post"><div class = "form-items">
            <label for="deleteID">product id:</label><input type = "number" name = "deleteID" id = "deleteID" required>
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

<!-- PHP FOR FORM GANDLINFG -->
    <?php
        include "./php/submit.php";
        var_dump($_FILES);

        if ($_SERVER["REQUEST_METHOD"]=="POST") {
          if (isset($_POST["prodName"])) {
            echo "<script>alert('prod submited')</script>";
            $prodName = htmlspecialchars($_POST['prodName']);
            $description = htmlspecialchars($_POST['description']);

             if (isset($_FILES['prodImage']) && $_FILES['prodImage']['error'] === 0) {
              // Get the binary data of the uploaded image
              $imgData = file_get_contents($_FILES['prodImage']['tmp_name']);
            } else {
              // If no image is uploaded, set $imgData to NULL
              $imgData = null;
            }
            
            $prodPrice = htmlspecialchars($_POST['prodPrice']);
            $prodCat = htmlspecialchars($_POST['prodCat']);
            $prodBrand = htmlspecialchars($_POST['prodBrand']);

            echo $prodName;
            if(submit_product($prodName, $description, $imgData, $prodPrice, $prodCat, $prodBrand)) {
                echo "<p style='color: green;' class='alert'>product added!</p>";
                echo "<script>alert('prod submited')</script>";
            } else {
                echo "<p style='color: red;' class='alert'>product not added!</p>";
                echo "<p style='color: green;' class='alert'>NOT product added!</p>";
            }
          }
            
        }
    ?>


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
