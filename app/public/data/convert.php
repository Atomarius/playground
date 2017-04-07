<?php
$rows = json_decode(file_get_contents(__DIR__ . '/arrays.json'), true);


$data = [];
foreach ($rows['data'] as $key => $row) {
    $data[$key]["first_name"]= $row[0]; 
    $data[$key]["last_name"] = $row[1]; 
    $data[$key]["position"] = $row[2]; 
    $data[$key]["office"] = $row[3]; 
    $data[$key]["start_date"] = $row[4]; 
    $data[$key]["salary"]= str_replace(['$',','],['',''],$row[5]);
}

file_put_contents(__DIR__ . '/api.json', json_encode(['data' => $data]));