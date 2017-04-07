<?php
$records = json_decode(file_get_contents('api.json'), true);

$dir_map = ['asc' => 1, 'desc' => -1];
$column = $_GET['columns'][(int)$_GET['order'][0]['column']]['data'];
$dir = $dir_map[$_GET['order'][0]['dir']];

usort($records['data'], function($l, $r) use ($column, $dir) {return strcmp($l[$column], $r[$column]) * $dir;});

$data = [];

for($i = $_GET['start']; $i < min($_GET['length'] + $_GET['start'], count($records['data'])); $i++) {
   $data[] = $records['data'][$i];
}

$response = [
    'draw' => $_GET['draw'],
    'recordsTotal' => count($records['data']),
    'recordsFiltered' => count($records['data']),
    'data' => $data,
];

echo json_encode($response);