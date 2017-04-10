<?php
$records = json_decode(file_get_contents('api.json'), true);
switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $records['data'][] = $_POST;
        file_put_contents('api.json', json_encode($records));
        break;
}

echo json_encode($records);