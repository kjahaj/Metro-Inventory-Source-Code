<?php
include './connection.php';
include './user.php';
include './session.php';

$rowId = $_POST['rowId'];
$item = $_POST['item'];
$category = $_POST['category'];
$warehouse = $_POST['warehouse'];

$iIDQuery = "SELECT si.itemID, si.item, su.warehouse AS currentWarehouse
             FROM `stockItems` AS si
             INNER JOIN `storageUnits` AS su ON si.warehouseID = su.warehouseID
             WHERE si.itemID = '$rowId'"; 
$iIDResult = mysqli_query($conn, $iIDQuery);
$iIDRow = mysqli_fetch_assoc($iIDResult);
$iID = $iIDRow['itemID'];
$currentName = $iIDRow['item'];
$currentWarehouse = $iIDRow['currentWarehouse'];

$wIDQuery = "SELECT warehouseID, warehouse FROM `storageUnits` WHERE warehouse = '$warehouse'";
$wIDResult = mysqli_query($conn, $wIDQuery);
$wIDRow = mysqli_fetch_assoc($wIDResult);
$wID = $wIDRow['warehouseID'];
$newWarehouse = $wIDRow['warehouse'];

// Check if the warehouse has changed
if ($currentWarehouse != $newWarehouse) {
    $user = unserialize($_SESSION['user']);
    $warehouseChangeLog = "[" . date('Y-m-d H:i:s') ."] USER: ". $user->getName()." ".$user->getSurname(). "  Changed warehouse from: " . $currentWarehouse . " to " . $newWarehouse . "\n";

    $file = "../LOGS/logs.log";
    $data = file_get_contents($file); // Read the existing content of the file

    $handle = fopen($file, 'w'); // Open the file in write mode

    if ($handle !== false) {
        fwrite($handle, $warehouseChangeLog . $data); // Write the warehouse change log with current time followed by the existing content

        fclose($handle); // Close the file
    } else {
        echo "Error opening the file.";
    }
}

$sql = "UPDATE `stockItems` 
        SET item = '$item', 
        category = '$category', 
        warehouseID = '$wID'
        WHERE itemID = '$rowId'";

if ($conn->query($sql) === TRUE) {
    echo "Database updated successfully";
} else {
    echo "Error updating database: " . $conn;
}
if($currentName!== $item){
    $file = "../LOGS/logs.log";
    $user = unserialize($_SESSION['user']);
    $userFull = "[" . date('Y-m-d H:i:s') . "] USER: " . $user->getName() . " " . $user->getSurname() . " ITEM RENAMED FROM: " . $currentName . " TO " . $item. "\n";

    $data = file_get_contents($file); // Read the existing content of the file

    $handle = fopen($file, 'w'); // Open the file in write mode

    if ($handle !== false) {
        fwrite($handle, $userFull . $data); // Write the content with current time followed by the existing content

        fclose($handle); // Close the file
    } else {
        echo "Error opening the file.";
    }
}

echo($currentName);

$conn->close();
?>
