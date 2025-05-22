<?php
header('Content-Type: application/json');
require_once '../model/topicDao.php';

if (!isset($_GET['boardid'])) {
    echo json_encode(['error' => 'Missing boardid parameter']);
    exit;
}

$boardid = intval($_GET['boardid']);

try {
    // 获取该版块的帖子数量
    $topicCount = count_topics($boardid);

    echo json_encode([
        'status' => 'success',
        'boardid' => $boardid,
        'topicCount' => $topicCount
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
