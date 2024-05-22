<?php 

include './connection.php';

$sql = "SELECT quantity
        FROM `stockItems`";

$result = mysqli_query($conn, $sql);

if(!$result){
    exit;
}

$data = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

$totalQuantity = 0;

foreach ($data as $row) {
    $totalQuantity += $row['quantity'];
}

echo json_encode($totalQuantity);
mysqli_close($conn);
