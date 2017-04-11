<?php
$records = json_decode(file_get_contents('api.json'), true);
switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        foreach ($_POST as $key => $val) {
            if ($_POST[$key] == '') {
                header("HTTP/1.1 400 Bad Request");
                header('Content-Type: application/json');
                echo json_encode(['error' => "{$key} empty."]);
                die();
            }
        }
        $records['data'][] = $_POST;
        file_put_contents('api.json', json_encode($records));
        break;
}

echo json_encode($records);