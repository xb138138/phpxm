<?php
require_once '../model/boardDao.php';

header('Content-Type: application/json');

$parentid = isset($_GET['parentid']) ? intval($_GET['parentid']) : 0;
$sonBoards = get_son_boards($parentid);

echo json_encode($sonBoards, JSON_UNESCAPED_UNICODE);