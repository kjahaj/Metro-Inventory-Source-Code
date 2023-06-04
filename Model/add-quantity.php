<?php
include "./connection.php";
include "./user.php";

// Prepare the SQL query
$sql = "SELECT item FROM stockitems;";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Fetch the data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['item'];
}
// Return the data as JSON
echo json_encode($data);

// Close the database connection
mysqli_close($conn);
?>
