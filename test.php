<?php
// Include the database connection
// Database connection settings
$host = 'localhost'; // or your database host
$username = 'root';  // your database username
$password = '';      // your database password
$dbname = 'php-store-project_db'; // your database name

// Create connection
$link = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}


// Function to fetch all products with their image data
function get_all_products() {
    global $link;
    $sql = "SELECT ID, name, img FROM products";  // Adjust table and column names as needed
    $result = $link->query($sql);

    return $result;
}

// Fetch all products
$products = get_all_products();

// Start HTML output
echo "<html><body>";
echo "<h1>Product Images</h1>";

if ($products->num_rows > 0) {
    // Loop through the products and display their images
    while ($row = $products->fetch_assoc()) {
        $prodId = $row['ID'];
        $prodName = $row['name'];
        $imgData = $row['img'];

        echo "<h3>Product: " . htmlspecialchars($prodName) . "</h3>";

        if ($imgData !== null) {
            // Convert the binary image data to base64
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="' . htmlspecialchars($prodName) . '" width="200" />';
        } else {
            echo "<p>No image available</p>";
        }

        echo "<hr>";
    }
} else {
    echo "<p>No products found</p>";
}

echo "</body></html>";
?>
