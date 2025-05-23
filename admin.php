<?php session_start(); ?>
<?php if ($_SESSION["type"] != "admin") {
    header("location: ./");
    exit();
}
?>
<?php
  if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
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
    <link rel="stylesheet" href="./css/footer.css">
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
            <label for="editName">product name:</label><input type = "text" name = "editName" id = "editName" >
            <label for="editdescription">product description:</label><textarea name="editdescription" id="editdescription" ></textarea>
            <label for="editImage">product image:</label><input type = "file" name = "editImage" id = "editImage">
            <label for="editPrice">product price:</label><input type = "number" name = "editPrice" id = "editPrice" >
            <label for="editCat">product category:</label><input type = "text" name = "editCat" id = "editCat" >
            <label for="editBrand">product brand:</label><input type = "text" name = "editBrand" id = "editBrand" >
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
      <button type="submit" name="logout">
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

        // adding code
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
          if (isset($_POST["prodName"])) {
            $prodName = htmlspecialchars($_POST['prodName']);
            $description = htmlspecialchars($_POST['description']);

             if (isset($_FILES['prodImage']) && $_FILES['prodImage']['error'] === 0) {
              $imgData = file_get_contents($_FILES['prodImage']['tmp_name']);
            } else {
              $imgData = null;
            }
            
            $prodPrice = htmlspecialchars($_POST['prodPrice']);
            $prodCat = htmlspecialchars($_POST['prodCat']);
            $prodBrand = htmlspecialchars($_POST['prodBrand']);

            if(submit_product($prodName, $description, $imgData, $prodPrice, $prodCat, $prodBrand)) {
                echo "<p style='color: green;' class='alert'>product added!</p>";
                echo "<script>alert('prod submited')</script>";
            } else {
                echo "<p style='color: red;' class='alert'>product not added!</p>";
                echo "<script>alert('error submitting!')</script>";
            }
          }
          //editing code
          if (isset($_POST["editID"])) {
            $status = "";
            $prodID = $_POST["editID"];
            if (isset($_POST["editName"]) && !empty($_POST["editName"])) {
              if (edit_product($prodID, "name", $_POST["editName"])){
                $status .= " name";
              }
            }
            if (isset($_POST["editdescription"]) && !empty($_POST["editdescription"])) {
              if (edit_product($prodID, "description", $_POST["editdescription"])){
                $status .= " desc";
              }
            }
            if (isset($_FILES['editImage']) && $_FILES['editImage']['error'] === 0) {
              $imgData = file_get_contents($_FILES['editImage']['tmp_name']);
              if (edit_product($prodID, "img", $imgData)){
              $status .= " img";
            }
            }
            
            if (isset($_POST["editPrice"]) && !empty($_POST["editPrice"])) {
              if (edit_product($prodID, "price", $_POST["editPrice"])){
                $status .= " price";
              }
            }
            if (isset($_POST["editCat"]) && !empty($_POST["editCat"])) {
              if (edit_product($prodID, "category", $_POST["editCat"])){
                $status .= " category";
              }
            }
            if (isset($_POST["editBrand"]) && !empty($_POST["editBrand"])) {
              if (edit_product($prodID, "brand", $_POST["editBrand"])){
                $status .= " brand";
              }
            }
            echo "<script>alert('$status updated!')</script>";
          }
        }

        //DELETE
        if (isset($_POST["deleteID"])) {
          if(delete_product($_POST["deleteID"])){
            echo "<script>alert('delete successful')</script>";
          }
        }
    ?>

<div style = "position: absolute; bottom: 0;">
      <footer>
        <nav>
            <a href="./">home</a>
            <a href="adminAcc.php">guerer comptes</a>
        </nav>
    </footer>
</div>
    
</body>
</html>
