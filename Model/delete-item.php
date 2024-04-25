<?php
include './connection.php';
include './user.php';
include './session.php';

$itemID = $_POST['itemID'];

$itemQuery = "SELECT item FROM stockItems WHERE itemID = $itemID";
$itemResult = mysqli_query($conn, $itemQuery);
$itemRow = mysqli_fetch_assoc($itemResult);
$item = $itemRow['item'];

$sql = "DELETE FROM `stockItems` WHERE itemID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemID);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $message = "Item deleted!";
    echo $message;
} else {
    $message = "No item  deleted!";
    echo $message;
}

$file = "../LOGS/logs.log";
$user = unserialize($_SESSION['user']);
$fullMessage = "[" . date('Y-m-d H:i:s') . "]" . " USER: " . $user->getName() . " " . $user->getSurname() . " DELETED ITEM " . $item . "\n";
$data = file_get_contents($file);
$handle = fopen($file, 'w');
if ($handle !== false) {
    fwrite($handle, $fullMessage . $data); // Write the content with current time followed by the existing content

    fclose($handle); // Close the file
} else {
    echo "Error opening the file.";
}

$stmt->close();
$conn->close();

?>
