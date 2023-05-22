<?php
include "./connection.php";

$item = $_POST['item'];
$category = $_POST['category'];

// Step 3: Prepare the SQL query
$sql1 = "INSERT INTO `stock-items` (item, category) VALUES (?, ?)";

// Step 4: Bind the parameters
$stmt = mysqli_prepare($conn, $sql1);
mysqli_stmt_bind_param($stmt, "ss", $item, $category);

// Step 5: Execute the query
if (mysqli_stmt_execute($stmt)) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Step 6: Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
