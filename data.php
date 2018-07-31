<?php

error_reporting(0);


//$limit = [$_GET['start'], $_GET['length']];

// LIMIT 0,10
// LIMIT 10,10
// LIMIT 20,10
// LIMIT 30,10
$limit = [$_GET['start'], $_GET['length']];

$orderRequestData = $_GET['order'];
$orderArr = [];
foreach ($orderRequestData as $colData) {
    $colIndex = $colData['column'];
    $colDirection = $colData['dir'];
    $colName = $_GET['columns'][$colIndex]['data'];
    $orderArr[] = $colName . " " . $colDirection;
}

$searchKey = $_GET['search']['value'];
$data = [
    "conditions" => "title LIKE ?",
    "bind" => ["%$searchKey%"]
];

$result = \Ayep\Model\Product::find($data, $orderArr, $limit);

$count = \Ayep\Model\Product::count();

$filteredCount = \Ayep\Model\Product::count($data);

echo json_encode([
    'recordsTotal' => $count,
    'recordsFiltered' => $filteredCount,
    'data' => $result
]);

