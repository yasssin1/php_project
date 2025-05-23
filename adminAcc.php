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
            <button class = "form-name" onclick="showTab(event, 'Edit')">Edit</button>
            <button class = "form-name" onclick="showTab(event, 'Profils')">list de profils</button>
            <button class = "form-name" onclick="showTab(event, 'Delete')">Delete</button>
        </div>

        <!-- EDIT FORM -->
        <form id="Edit" class="tab-content" method="post" enctype="multipart/form-data"><div class = "form-items">
            <input type = "hidden" id = "edit">
            <label for="editID">account id:</label><input type = "number" name = "editID" id = "editID" required>
            <label for="editName">account name:</label><input type = "text" name = "editName" id = "editName" >
            <label for="editPassword">account password:</label><input type = "password" name="editPassword" id="editPassword" ></textarea>
            <label for="editEmail">product email:</label><input type = "text" name = "editEmail" id = "editEmail">
            <label for="editType">account type:</label>
                <select id="editType" name="editType">
                    <option value="standard">standard</option>
                    <option value="admin">admin</option>
                </select>
        </div>
        
            <input type="submit" value="Edit">
        </form>
        <!-- affichage de profils -->
        <input type = "hidden" id = "profils">
        <div id="Profils" class="tab-content" method="post">
            <?php
            include "./php/submit.php";
                echo "profils:";
                $sql = "SELECT ID, name, email, type FROM `accounts`";
                $result = $link->query($sql);

                // cas ou des resultats
                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>";

                    // Parcours des résultats et affichage dans un tableau HTML
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['ID'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['type'] . "</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucun profil";
                }
            ?>
        </div>
        <!-- supprimer -->
        <input type = "hidden" id = "delete">
        <form id="Delete" class="tab-content" method="post"><div class = "form-items">
            <label for="deleteID">account id:</label><input type = "number" name = "deleteID" id = "deleteID" required>
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
        

        // adding code
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
          //editing code
          if (isset($_POST["editID"])) {
            $status = "";
            $userID = $_POST["editID"];
            if (isset($_POST["editName"]) && !empty($_POST["editName"])) {
              if (edit_account($userID, "name", $_POST["editName"])){
                $status .= " name";
              }
            }
            if (isset($_POST["editPassword"]) && !empty($_POST["editPassword"])) {
              if (edit_account($userID, "password", $_POST["editPassword"])){
                $status .= " pass";
              }
            }
            
            
            if (isset($_POST["editEmail"]) && !empty($_POST["editEmail"])) {
              if (edit_account($userID, "email", $_POST["editEmail"])){
                $status .= " email";
              }
            }
            if (isset($_POST["editType"]) && !empty($_POST["editType"])) {
              if (edit_account($userID, "type", $_POST["editType"])){
                $status .= " type";
              }
            }
            echo "<script>alert('$status updated!')</script>";
          }
        }


        if (isset($_POST["deleteID"])) {
          if(delete_account($_POST["deleteID"])){
            echo "<script>alert('delete successful')</script>";
          }
        }
        
    ?>

<div style = "position: absolute; bottom: 0;">
      <footer>
        <nav>
            <a href="./">home</a>
            <a href="admin.php">guerer produit</a>
        </nav>
    </footer>
</div>
    
</body>
</html>
