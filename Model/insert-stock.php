<?php
include './connection.php';
include './user.php';
include './session.php';

$item = $_POST['item'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$warehouse = $_POST['warehouse'];

// Validate form inputs
if (empty($item) || empty($category) || empty($quantity) || empty($warehouse)) {
    echo "Please fill out all the fields.";
} elseif (!is_numeric($quantity) || $quantity <= 0) {
    echo "Quantity must be a positive number.";
} else {
    $wIDQuery = "SELECT warehouseID FROM `storageUnits` WHERE warehouse = '$warehouse'";
    $wIDResult = mysqli_query($conn, $wIDQuery);
    $wIDRow = mysqli_fetch_assoc($wIDResult);
    $wID = $wIDRow['warehouseID'];

    // Prepare the SQL query
    $sql = "INSERT INTO `stockItems` (item, category, quantity, warehouseID) VALUES (?, ?, ?, ?)";

    // Bind the parameters
    $stmt = mysqli_prepare($conn, $sql);
    var_dump($category);
    mysqli_stmt_bind_param($stmt, "ssii", $item, $category, $quantity, $wID);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Construct success message
        $successMessage = "Data inserted successfully.";
        // Return success message
        echo $successMessage;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $file = "../LOGS/logs.log";
    $user = unserialize($_SESSION['user']);
    $userFull = "[" . date('Y-m-d H:i:s') . "] USER: " . $user->getName() . " " . $user->getSurname() . " INSERTED: " . "ITEM NAME: " . $item . " WITH QUANTITY: " . $quantity . " IN THE WAREHOUSE: " . $warehouse . "\n";
    
    $data = file_get_contents($file); // Read the existing content of the file
    
    $handle = fopen($file, 'w'); // Open the file in write mode
    
    if ($handle !== false) {
        fwrite($handle, $userFull . $data); // Write the content with current time followed by the existing content
    
        fclose($handle); // Close the file
    } else {
        echo "Error opening the file.";
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
