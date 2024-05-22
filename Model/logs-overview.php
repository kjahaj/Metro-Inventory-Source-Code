<?php
$log_file = '../LOGS/logs.log';
$log_data = array_slice(file($log_file), -3);

$log_entries = array();
foreach ($log_data as $line) {
 
    preg_match('/\[(.*?)\] USER: (.*?) (.*?) (.*)/', $line, $matches);
    

    $log_entry = array(
        'timestamp' => $matches[1], 
        'user' => $matches[2], 
        'action' => $matches[3], 
        'details' => $matches[4] 
    );


    $log_entries[] = $log_entry;
}

header('Content-Type: application/json');
echo json_encode($log_entries);
